<?php

declare(strict_types=1);

it('should generate config from input', function () {
    $this->artisan('test:config')
        ->expectsQuestion('Enter resource name (singular, camel-cased)', 'productFeature')
        ->expectsQuestion('Enter root namespace', 'Virgo')
        ->expectsQuestion('Enter root namespace path', 'src')
        ->expectsOutput('Resource: productFeature')
        ->expectsOutput('Namespace: Virgo\ProductFeatures')
        ->expectsOutput('Path: '.base_path('src/ProductFeatures'))
        ->assertExitCode(0);
});

it('should generate config from arguments', function () {
    $this->artisan('test:config productFeature --namespace=Virgo --path=src')
        ->expectsOutput('Resource: productFeature')
        ->expectsOutput('Namespace: Virgo\ProductFeatures')
        ->expectsOutput('Path: '.base_path('src/ProductFeatures'))
        ->assertExitCode(0);
});

it('should generate config from arguments and ask for missing params', function (string $command, array $questions) {
    $expectation = $this->artisan($command);

    foreach ($questions as $question) {
        $expectation->expectsQuestion($question[0], $question[1]);
    }

    $expectation->expectsOutput('Resource: productFeature')
        ->expectsOutput('Namespace: Virgo\ProductFeatures')
        ->expectsOutput('Path: '.base_path('src/ProductFeatures'))
        ->assertExitCode(0);
})->with([
    [
        'command' => 'test:config productFeature',
        'questions' => [
            ['Enter root namespace', 'Virgo'],
            ['Enter root namespace path', 'src'],
        ],
    ],
    [
        'command' => 'test:config productFeature --namespace=Virgo',
        'questions' => [
            ['Enter root namespace path', 'src'],
        ],
    ],
    [
        'command' => 'test:config productFeature --path=src',
        'questions' => [
            ['Enter root namespace', 'Virgo'],
        ],
    ],
    [
        'command' => 'test:config --namespace=Virgo --path=src',
        'questions' => [
            ['Enter resource name (singular, camel-cased)', 'productFeature'],
        ],
    ],
]);

it('should use package config', function () {
    config()->set('laniakea-generator.root_namespace', 'Virgo');
    config()->set('laniakea-generator.root_path', 'src');

    expect(config('laniakea-generator.root_namespace'))->toBe('Virgo')
        ->and(config('laniakea-generator.root_path'))->toBe('src');

    $this->artisan('test:config productFeature')
        ->expectsOutput('Resource: productFeature')
        ->expectsOutput('Namespace: Virgo\ProductFeatures')
        ->expectsOutput('Path: '.base_path('src/ProductFeatures'))
        ->assertExitCode(0);
});

it('should prioritize arguments over package config', function () {
    config()->set('laniakea-generator.root_namespace', 'Virgo');
    config()->set('laniakea-generator.root_path', 'src');

    expect(config('laniakea-generator.root_namespace'))->toBe('Virgo')
        ->and(config('laniakea-generator.root_path'))->toBe('src');

    $this->artisan('test:config productFeature --namespace=App --path=app')
        ->expectsOutput('Resource: productFeature')
        ->expectsOutput('Namespace: App\ProductFeatures')
        ->expectsOutput('Path: '.base_path('app/ProductFeatures'))
        ->assertExitCode(0);
});
