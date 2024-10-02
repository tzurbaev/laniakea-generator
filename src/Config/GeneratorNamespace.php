<?php

declare(strict_types=1);

namespace Laniakea\Generator\Config;

readonly class GeneratorNamespace
{
    public function __construct(private string $namespace, private string $path)
    {
        //
    }

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Get full path to the root directory.
     *
     * @return string
     */
    public function getFullPath(): string
    {
        return base_path($this->path);
    }
}
