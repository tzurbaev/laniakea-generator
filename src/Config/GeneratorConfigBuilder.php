<?php

declare(strict_types=1);

namespace Laniakea\Generator\Config;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Laniakea\Generator\Enums\Replacement;

use function Laravel\Prompts\text;

readonly class GeneratorConfigBuilder
{
    /**
     * Create generator config from command input or configuration file.
     *
     * @param Command $command
     *
     * @return GeneratorConfig
     */
    public function getConfig(Command $command): GeneratorConfig
    {
        $resource = new GeneratorResource($this->getResourceName($command));

        return new GeneratorConfig(
            resource: $resource,
            namespace: $this->getNamespace($resource, $command),
        );
    }

    /**
     * Get resource name from command argument or ask user for input.
     *
     * @param Command $command
     *
     * @return string
     */
    protected function getResourceName(Command $command): string
    {
        $resource = $command->argument('resource');

        if (!empty($resource)) {
            return $resource;
        }

        return text(
            label: 'Enter resource name (singular, camel-cased)',
            placeholder: 'For example, productFeature',
            required: true,
        );
    }

    /**
     * Get namespace and path from command options, package config or ask user for input.
     *
     * @param GeneratorResource $resource
     * @param Command           $command
     *
     * @return GeneratorNamespace
     */
    protected function getNamespace(GeneratorResource $resource, Command $command): GeneratorNamespace
    {
        $namespace = $command->option('namespace') ?: config('laniakea-generator.root_namespace') ?? text(
            label: 'Enter root namespace',
            default: config('laniakea-generator.root_namespace') ?? '',
            required: true,
            hint: 'Without resource name. Example: App\Services',
        );

        $path = $command->option('path') ?: config('laniakea-generator.root_path') ?? text(
            label: 'Enter root namespace path',
            default: config('laniakea-generator.root_path') ?? '',
            required: true,
            hint: 'Relative to app dir, without resource name. Example: app/Services',
        );

        // Since we're asking for root namespace and path,
        // we need to append the resource name to the both namespace and path.

        return new GeneratorNamespace(
            namespace: Str::replace($resource->search, $resource->replacements, $namespace.'\\'.Replacement::RESOURCE_PLURAL_UCFIRST->value),
            path: Str::replace($resource->search, $resource->replacements, $path.'/'.Replacement::RESOURCE_PLURAL_UCFIRST->value),
        );
    }
}
