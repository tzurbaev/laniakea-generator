<?php

declare(strict_types=1);

namespace Laniakea\Generator\Config;

class GeneratorConfig
{
    protected array $customReplacements = [];

    public function __construct(
        public readonly GeneratorResource $resource,
        public readonly GeneratorNamespace $namespace,
        public readonly string $stubsGroup = 'default',
        public readonly bool $forceVendorStubs = false,
    ) {
        //
    }

    /**
     * Add custom replacements to be used in stubs.
     *
     * @param array $replacements
     *
     * @return $this
     */
    public function addCustomReplacements(array $replacements): static
    {
        $this->customReplacements = [
            ...$this->customReplacements,
            ...$replacements,
        ];

        return $this;
    }

    /**
     * Get list of custom replacements.
     *
     * @return array
     */
    public function getCustomReplacements(): array
    {
        return $this->customReplacements;
    }
}
