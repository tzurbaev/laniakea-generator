<?php

declare(strict_types=1);

namespace Laniakea\Generator\Config;

use Illuminate\Support\Str;
use Laniakea\Generator\Enums\Replacement;

readonly class GeneratorResource
{
    public array $replacements;
    public array $search;

    public function __construct(public string $name)
    {
        $this->replacements = $this->getReplacements();
        $this->search = array_keys($this->replacements);
    }

    /**
     * Get possible replacements for the resource name.
     *
     * @return array
     */
    protected function getReplacements(): array
    {
        $singular = Str::camel($this->name); // productFeature
        $plural = Str::plural($singular); // productFeatures

        return [
            Replacement::RESOURCE_SINGULAR->value => $singular, // productFeature
            Replacement::RESOURCE_SINGULAR_SNAKE->value => Str::snake($singular), // product_feature
            Replacement::RESOURCE_SINGULAR_UCFIRST->value => Str::ucfirst($singular), // ProductFeature
            Replacement::RESOURCE_SINGULAR_WORDS->value => Str::snake($singular, ' '), // product feature
            Replacement::RESOURCE_SINGULAR_WORDS_TITLE->value => Str::title(Str::snake($singular, ' ')), // Product Feature

            Replacement::RESOURCE_PLURAL->value => $plural, // productFeatures
            Replacement::RESOURCE_PLURAL_SNAKE->value => Str::snake($plural), // product_features
            Replacement::RESOURCE_PLURAL_UCFIRST->value => Str::ucfirst($plural), // ProductFeatures
            Replacement::RESOURCE_PLURAL_WORDS->value => Str::snake($plural, ' '), // product features
            Replacement::RESOURCE_PLURAL_WORDS_TITLE->value => Str::title(Str::snake($plural, ' ')), // Product Features
        ];
    }
}
