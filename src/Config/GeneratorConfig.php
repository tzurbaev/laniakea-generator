<?php

declare(strict_types=1);

namespace Laniakea\Generator\Config;

readonly class GeneratorConfig
{
    public function __construct(
        public GeneratorResource $resource,
        public GeneratorNamespace $namespace,
        public bool $forceDefaultStubs = false,
    ) {
        //
    }
}
