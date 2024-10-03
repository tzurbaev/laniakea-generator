<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Laniakea\Generator\Config\GeneratorConfig;
use Laniakea\Generator\Config\GeneratorNamespace;
use Laniakea\Generator\Config\GeneratorResource;
use Laniakea\Generator\Enums\OverrideFileAnswer;
use Laniakea\Generator\Enums\Replacement;
use Laniakea\Generator\Generator;
use Laniakea\Generator\Writer;

it('should generate files list', function () {
    $resource = new GeneratorResource('productFeature');
    $config = new GeneratorConfig(
        resource: $resource,
        namespace: new GeneratorNamespace(
            namespace: Str::replace(
                $resource->search,
                $resource->replacements,
                'Laniakea\Tests\Workbench\\'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
            path: Str::replace(
                $resource->search,
                $resource->replacements,
                'src/'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
        ),
    );

    $generator = new Generator($config);
    $files = $generator->getFiles();

    expect($files)->toHaveCount(count(config('laniakea-generator.stubs')));
    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);

        expect($file['contents'])->toBe($expected);
    });
});

it('should write generated files', function () {
    $resource = new GeneratorResource('productFeature');
    $config = new GeneratorConfig(
        resource: $resource,
        namespace: new GeneratorNamespace(
            namespace: Str::replace(
                $resource->search,
                $resource->replacements,
                'Laniakea\Tests\Workbench\\'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
            path: Str::replace(
                $resource->search,
                $resource->replacements,
                'src/'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
        ),
    );

    $generator = new Generator($config);
    $files = $generator->getFiles();

    // Make sure we're rm-rfing directory inside vendor/orchestra folder.
    $expectedTargetDir = base_path('src');
    $actualTargetDir = realpath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel').'/src';

    expect($actualTargetDir)->toBe($expectedTargetDir);

    if (is_dir($actualTargetDir)) {
        shell_exec('rm -rf '.$actualTargetDir);
    }

    $writer = new Writer();
    $count = $writer->write($files, fn () => OverrideFileAnswer::YES_ALL);
    expect($count)->toBe(count($files));

    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);
        $actual = file_get_contents($file['target']['path']);

        expect($actual)->toBe($expected);
    });

    shell_exec('rm -rf '.$actualTargetDir);
});

it('should generate and write files using console command', function () {
    // Make sure we're rm-rfing directory inside vendor/orchestra folder.
    $expectedTargetDir = base_path('src');
    $actualTargetDir = realpath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel').'/src';

    expect($actualTargetDir)->toBe($expectedTargetDir);

    if (is_dir($actualTargetDir)) {
        shell_exec('rm -rf '.$actualTargetDir);
    }

    $stubsCount = count(config('laniakea-generator.stubs', []));

    $this->artisan('laniakea:generate')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Laniakea\Tests\Workbench')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Generating resource [productFeature].')
        ->expectsOutput('Root namespace: [Laniakea\Tests\Workbench\ProductFeatures], root path: ['.$actualTargetDir.'/ProductFeatures'.'].')
        ->expectsQuestion('Do you want to generate these files ('.$stubsCount.')?', 'yes')
        ->expectsOutput('Resource generated successfully, '.$stubsCount.' files were created.');

    // Retrieve generated files
    $resource = new GeneratorResource('productFeature');
    $config = new GeneratorConfig(
        resource: $resource,
        namespace: new GeneratorNamespace(
            namespace: Str::replace(
                $resource->search,
                $resource->replacements,
                'Laniakea\Tests\Workbench\\'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
            path: Str::replace(
                $resource->search,
                $resource->replacements,
                'src/'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
        ),
    );

    $generator = new Generator($config);
    $files = $generator->getFiles();

    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);
        $actual = file_get_contents($file['target']['path']);

        expect($actual)->toBe($expected);
    });

    shell_exec('rm -rf '.$actualTargetDir);
});

it('should override existed files', function () {
    // Make sure we're rm-rfing directory inside vendor/orchestra folder.
    $expectedTargetDir = base_path('src');
    $actualTargetDir = realpath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel').'/src';

    expect($actualTargetDir)->toBe($expectedTargetDir);

    if (is_dir($actualTargetDir)) {
        shell_exec('rm -rf '.$actualTargetDir);
    }

    $stubsCount = count(config('laniakea-generator.stubs', []));

    $this->artisan('laniakea:generate')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Laniakea\Tests\Workbench')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Generating resource [productFeature].')
        ->expectsOutput('Root namespace: [Laniakea\Tests\Workbench\ProductFeatures], root path: ['.$actualTargetDir.'/ProductFeatures'.'].')
        ->expectsQuestion('Do you want to generate these files ('.$stubsCount.')?', 'yes')
        ->expectsOutput('Resource generated successfully, '.$stubsCount.' files were created.');

    // Retrieve generated files
    $resource = new GeneratorResource('productFeature');
    $config = new GeneratorConfig(
        resource: $resource,
        namespace: new GeneratorNamespace(
            namespace: Str::replace(
                $resource->search,
                $resource->replacements,
                'Laniakea\Tests\Workbench\\'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
            path: Str::replace(
                $resource->search,
                $resource->replacements,
                'src/'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
        ),
    );

    $generator = new Generator($config);
    $files = $generator->getFiles();

    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);
        $actual = file_get_contents($file['target']['path']);

        expect($actual)->toBe($expected);
    });

    $firstFile = Str::replace(base_path('src'), '', $files[0]['target']['path']);

    // Run again with new namespace.
    $this->artisan('laniakea:generate')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Laniakea\Tests\WorkbenchSecond')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Generating resource [productFeature].')
        ->expectsOutput('Root namespace: [Laniakea\Tests\WorkbenchSecond\ProductFeatures], root path: ['.$actualTargetDir.'/ProductFeatures'.'].')
        ->expectsQuestion('Do you want to generate these files ('.$stubsCount.')?', 'yes')
        ->expectsQuestion('File ['.$actualTargetDir.$firstFile.'] already exists. Override?', OverrideFileAnswer::YES_ALL->value)
        ->expectsOutput('Resource generated successfully, '.$stubsCount.' files were created.');

    // All files were overriden, no similar files should be found.
    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);
        $actual = file_get_contents($file['target']['path']);

        expect($actual)->not->toBe($expected);
    });

    shell_exec('rm -rf '.$actualTargetDir);
});

it('should not override existed files', function () {
    // Make sure we're rm-rfing directory inside vendor/orchestra folder.
    $expectedTargetDir = base_path('src');
    $actualTargetDir = realpath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel').'/src';

    expect($actualTargetDir)->toBe($expectedTargetDir);

    if (is_dir($actualTargetDir)) {
        shell_exec('rm -rf '.$actualTargetDir);
    }

    $stubsCount = count(config('laniakea-generator.stubs', []));

    $this->artisan('laniakea:generate')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Laniakea\Tests\Workbench')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Generating resource [productFeature].')
        ->expectsOutput('Root namespace: [Laniakea\Tests\Workbench\ProductFeatures], root path: ['.$actualTargetDir.'/ProductFeatures'.'].')
        ->expectsQuestion('Do you want to generate these files ('.$stubsCount.')?', 'yes')
        ->expectsOutput('Resource generated successfully, '.$stubsCount.' files were created.');

    // Retrieve generated files
    $resource = new GeneratorResource('productFeature');
    $config = new GeneratorConfig(
        resource: $resource,
        namespace: new GeneratorNamespace(
            namespace: Str::replace(
                $resource->search,
                $resource->replacements,
                'Laniakea\Tests\Workbench\\'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
            path: Str::replace(
                $resource->search,
                $resource->replacements,
                'src/'.Replacement::RESOURCE_PLURAL_UCFIRST->value,
            ),
        ),
    );

    $generator = new Generator($config);
    $files = $generator->getFiles();

    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);
        $actual = file_get_contents($file['target']['path']);

        expect($actual)->toBe($expected);
    });

    $firstFile = Str::replace(base_path('src'), '', $files[0]['target']['path']);

    // Run again with new namespace.
    $this->artisan('laniakea:generate')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Laniakea\Tests\WorkbenchSecond')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Generating resource [productFeature].')
        ->expectsOutput('Root namespace: [Laniakea\Tests\WorkbenchSecond\ProductFeatures], root path: ['.$actualTargetDir.'/ProductFeatures'.'].')
        ->expectsQuestion('Do you want to generate these files ('.$stubsCount.')?', 'yes')
        ->expectsQuestion('File ['.$actualTargetDir.$firstFile.'] already exists. Override?', OverrideFileAnswer::NO_ALL->value)
        ->expectsOutput('Resource generated successfully, 0 files were created.');

    // No files were overriden.
    collect($files)->each(function (array $file) {
        $path = Str::replace(base_path('src'), '', $file['target']['path']);
        $comparePath = realpath(__DIR__.'/../Workbench'.$path);

        $expected = file_get_contents($comparePath);
        $actual = file_get_contents($file['target']['path']);

        expect($actual)->toBe($expected);
    });

    shell_exec('rm -rf '.$actualTargetDir);
});

it('should generate additional non-package stubs', function () {
    config()->set('laniakea-generator.stubs', [
        [
            'stub_path' => 'lang/langStub.php',
            'target_path' => '{base_path}/lang/en/{resource:plural}.php',
        ],
    ]);

    config()->set('laniakea-generator.stubs_dir', realpath(__DIR__.'/../Workbench/CustomStubs'));

    expect(config('laniakea-generator.stubs'))->toHaveCount(1)
        ->and(config('laniakea-generator.stubs_dir'))->toBeString()->toBe(realpath(__DIR__.'/../Workbench/CustomStubs'));

    $expectedTargetDir = base_path('lang/en');
    $actualTargetDir = realpath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel').'/lang';

    // Since lang/en directory might not exist, we can't use realpath on full path.
    // Instead, we'll check that expected dir starrts with actual dir target.
    expect(Str::startsWith($expectedTargetDir, $actualTargetDir))->toBeTrue();

    $actualTargetFile = $actualTargetDir.'/en/productFeatures.php';

    if (file_exists($actualTargetFile)) {
        unlink($actualTargetFile);
    }

    $targetDir = base_path('src');

    $this->artisan('laniakea:generate')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Laniakea\Tests\Workbench')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Generating resource [productFeature].')
        ->expectsOutput('Root namespace: [Laniakea\Tests\Workbench\ProductFeatures], root path: ['.$targetDir.'/ProductFeatures'.'].')
        ->expectsQuestion('Do you want to generate these files (1)?', 'yes')
        ->expectsOutput('Resource generated successfully, 1 file was created.');

    expect(file_exists($actualTargetFile))->toBeTrue();

    $actualFile = file_get_contents($actualTargetFile);
    $expectedFile = file_get_contents(__DIR__.'/../Workbench/ProductFeatures/lang/productFeatures.php');

    expect($actualFile)->toBe($expectedFile);

    unlink($actualTargetFile);
});
