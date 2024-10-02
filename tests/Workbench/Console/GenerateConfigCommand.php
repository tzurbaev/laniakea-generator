<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\Console;

use Illuminate\Console\Command;
use Laniakea\Generator\Config\GeneratorConfigBuilder;

class GenerateConfigCommand extends Command
{
    protected $signature = 'test:config {resource?} {--namespace=} {--path=}';

    public function handle(GeneratorConfigBuilder $configBuilder): int
    {
        $config = $configBuilder->getConfig($this);

        $this->info('Resource: '.$config->resource->name);
        $this->info('Namespace: '.$config->namespace->getNamespace());
        $this->info('Path: '.$config->namespace->getFullPath());

        return 0;
    }
}
