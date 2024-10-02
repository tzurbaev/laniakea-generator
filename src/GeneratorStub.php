<?php

declare(strict_types=1);

namespace Laniakea\Generator;

use Laniakea\Generator\Enums\Stub;

readonly class GeneratorStub
{
    public function __construct(
        private Stub $stub,
        private string $targetClass,
        private string $targetPath,
        private string $defaultDir,
        private ?string $customDir,
    ) {
        //
    }

    /**
     * Get full path for the current stub.
     * If a custom stub file is found, it will be used instead of the default one.
     *
     * @return string
     */
    public function getStubPath(): string
    {
        $path = $this->stub->getPath();
        $customPath = $this->customDir ? realpath($this->customDir.'/'.$path) : null;

        if (!is_null($customPath) && $customPath !== false) {
            return $customPath;
        }

        return realpath($this->defaultDir.'/'.$path);
    }

    /**
     * Get the class name of the current stub.
     *
     * @return string
     */
    public function getStubClass(): string
    {
        return $this->stub->getClass();
    }

    /**
     * Get the target class name.
     *
     * @return string
     */
    public function getTargetClass(): string
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
