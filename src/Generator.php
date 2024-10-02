<?php

declare(strict_types=1);

namespace Laniakea\Generator;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laniakea\Generator\Config\GeneratorConfig;
use Laniakea\Generator\Enums\Replacement;
use Laniakea\Generator\Enums\Stub;

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
        $stubs = config('laniakea-generator.stubs', []);
        $customDir = $this->config->forceDefaultStubs ? null : config('laniakea-generator.stubs_dir');

        return collect($stubs)->map(function (array $data, string $stubName) use ($customDir) {
            $stub = Stub::tryFrom($stubName);

            if (is_null($stub)) {
                return null;
            } elseif (!isset($data['class']) || !isset($data['path'])) {
                return null;
            }

            return new GeneratorStub(
                stub: $stub,
                targetClass: $data['class'],
                targetPath: $data['path'],
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

        // Base replacements will be used while generating stub replacements
        // and custom replacements from config file.
        $baseReplacements = [
            Replacement::NAMESPACE->value => $this->config->namespace->getNamespace(),
            ...$this->config->resource->replacements,
        ];

        $stubReplacements = $this->getStubReplacements($stubs, $baseReplacements);

        $replacements = [
            ...$baseReplacements,
            ...$stubReplacements,
            'namespace Stubs\\' => 'namespace '.$this->config->namespace->getNamespace().'\\',
            ...$this->getCustomReplacements($baseReplacements),
            '{path}' => $this->config->namespace->getFullPath(),
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
     * If there are custom replacements in the config file, they will be applied to the source code.
     *
     * @param array $replacements
     *
     * @return array
     */
    protected function getCustomReplacements(array $replacements): array
    {
        $custom = config('laniakea-generator.custom_replacements', []);

        if (!count($custom)) {
            return [];
        }

        $search = array_keys($replacements);

        return collect($custom)->mapWithKeys(fn (string $value, string $key) => [
            $key => Str::replace($search, $replacements, $value),
        ])->toArray();
    }
}
