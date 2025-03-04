<?php

declare(strict_types=1);

namespace Laniakea\Generator;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laniakea\Generator\Config\GeneratorConfig;
use Laniakea\Generator\Enums\Replacement;

readonly class Generator
{
    public function __construct(private GeneratorConfig $config)
    {
        //
    }

    /**
     * Get stubs list.
     *
     * @return Collection<int, GeneratorStub>
     */
    protected function getStubs(): Collection
    {
        $stubs = config('laniakea-generator.stubs.'.$this->config->stubsGroup, []);
        $customDir = $this->config->forceVendorStubs ? null : config('laniakea-generator.stubs_dir');

        return collect($stubs)->map(function (array $data) use ($customDir) {
            if (!isset($data['stub_path']) || !isset($data['target_path'])) {
                return null;
            }

            return new GeneratorStub(
                stubClass: $data['stub_class'] ?? null,
                stubPath: $data['stub_path'],
                targetClass: $data['target_class'] ?? null,
                targetPath: $data['target_path'],
                defaultDir: __DIR__.'/../stubs',
                customDir: is_string($customDir) || is_null($customDir) ? $customDir : null,
            );
        })->reject(null)->values();
    }

    /**
     * Get generated files.
     *
     * @return array
     */
    public function getFiles(): array
    {
        $stubs = $this->getStubs();

        if (!count($stubs)) {
            return [];
        }

        // Base replacements will be used while generating stub replacements,
        // custom replacements from the config file, and replacements from custom questions.
        $baseReplacements = [
            Replacement::NAMESPACE->value => $this->config->namespace->getNamespace(),
            ...$this->config->resource->replacements,
            '{path}' => $this->config->namespace->getFullPath(),
            '{base_path}' => base_path(),
        ];

        // Stub replacements are used to replace FCQNs and base class names in the source code.
        $stubReplacements = $this->getStubReplacements($stubs, $baseReplacements);

        // All replacements will be applied to the source code.
        $replacements = [
            ...$baseReplacements,
            ...$stubReplacements,
            'namespace Stubs\\' => 'namespace '.$this->config->namespace->getNamespace().'\\',
            ...$this->getCustomReplacements($baseReplacements, config('laniakea-generator.custom_replacements', [])),
            ...$this->getCustomReplacements($baseReplacements, $this->config->getCustomReplacements()),
        ];

        $search = array_keys($replacements);

        return $stubs->map(function (GeneratorStub $stub) use ($search, $replacements) {
            $stubPath = $stub->getStubPath();

            if (!file_exists($stubPath)) {
                throw new \RuntimeException('Stub file ['.$stubPath.'] does not exist!');
            }

            $targetPath = Str::replace(
                $search,
                $replacements,
                $stub->getTargetPath(),
            );

            $contents = file_get_contents($stubPath);

            return [
                'target' => [
                    'directory' => dirname($targetPath),
                    'path' => $targetPath,
                ],
                'contents' => Str::replace($search, $replacements, $contents),
            ];
        })->toArray();
    }

    /**
     * Get replacements for stubs' FCQNs and base class names.
     *
     * @param Collection $stubs
     * @param array      $replacements
     *
     * @return array
     */
    protected function getStubReplacements(Collection $stubs, array $replacements): array
    {
        $search = array_keys($replacements);

        return $stubs->mapWithKeys(function (GeneratorStub $stub) use ($search, $replacements) {
            if (is_null($stub->getStubClass()) || is_null($stub->getTargetClass())) {
                return [];
            }

            $stubFCQN = Str::replace($search, $replacements, $stub->getStubClass());
            $targetFCQN = Str::replace($search, $replacements, $stub->getTargetClass());

            $stubBase = class_basename($stubFCQN);
            $targetBase = class_basename($targetFCQN);

            return [
                $stubFCQN => $targetFCQN,
                $stubBase => $targetBase,
            ];
        })->toArray();
    }

    /**
     * If there are custom replacements, they will be applied to the source code.
     *
     * @param array $replacements
     * @param array $custom
     *
     * @return array
     */
    protected function getCustomReplacements(array $replacements, array $custom): array
    {
        if (!count($custom)) {
            return [];
        }

        // Custom replacements might contain placeholders that need to be
        // replaced with the actual values. The `$replacements` array
        // is a base replacements list.
        $search = array_keys($replacements);

        return collect($custom)->mapWithKeys(fn (string $value, string $key) => [
            $key => Str::replace($search, $replacements, $value),
        ])->toArray();
    }
}
