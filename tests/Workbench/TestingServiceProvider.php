<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench;

use Illuminate\Support\ServiceProvider;
use Laniakea\Generator\Console\GenerateLaniakeaResourceCommand;
use Laniakea\Tests\Workbench\Console\GenerateConfigCommand;

class TestingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            GenerateConfigCommand::class,
            GenerateLaniakeaResourceCommand::class,
        ]);
    }
}
