<?php

declare(strict_types=1);

namespace Laniakea\Generator;

readonly class GeneratorStub
{
    public function __construct(
        private ?string $stubClass,
        private string $stubPath,
        private ?string $targetClass,
        private string $targetPath,
        private string $defaultDir,
        private ?string $customDir,
    ) {
        //
    }

    /**
     * Get the class name of the current stub.
     *
     * @return string|null
     */
    public function getStubClass(): ?string
    {
        return $this->stubClass;
    }

    /**
     * Get full path for the current stub.
     * If a custom stub file is found, it will be used instead of the default one.
     *
     * @return string
     */
    public function getStubPath(): string
    {
        $customPath = $this->customDir ? realpath($this->customDir.'/'.$this->stubPath) : null;

        if (!is_null($customPath) && $customPath !== false) {
            return $customPath;
        }

        $defaultPath = realpath($this->defaultDir.'/'.$this->stubPath);

        if ($defaultPath === false) {
            throw new \RuntimeException('Stub file ['.$this->stubPath.'] does not exist!');
        }

        return $defaultPath;
    }

    /**
     * Get the target class name.
     *
     * @return string|null
     */
    public function getTargetClass(): ?string
    {
        return $this->targetClass;
    }

    /**
     * Get the target path.
     *
     * @return string
     */
    public function getTargetPath(): string
    {
        return $this->targetPath;
    }
}
