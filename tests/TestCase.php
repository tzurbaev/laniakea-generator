<?php

declare(strict_types=1);

namespace Laniakea\Tests;

use Laniakea\Generator\LaniakeaGeneratorServiceProvider;
use Laniakea\Tests\Workbench\TestingServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaniakeaGeneratorServiceProvider::class,
            TestingServiceProvider::class,
        ];
    }
}
