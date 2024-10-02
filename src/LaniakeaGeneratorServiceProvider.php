<?php

declare(strict_types=1);

namespace Laniakea\Generator;

use Illuminate\Support\ServiceProvider;
use Laniakea\Generator\Console\GenerateLaniakeaResourceCommand;

class LaniakeaGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Boot services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/laniakea-generator.php' => config_path('laniakea-generator.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateLaniakeaResourceCommand::class,
            ]);
        }
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laniakea-generator.php', 'laniakea-generator');
    }
}
