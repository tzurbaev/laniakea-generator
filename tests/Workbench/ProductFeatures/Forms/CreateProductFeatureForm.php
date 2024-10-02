<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Forms;

class CreateProductFeatureForm extends AbstractProductFeatureForm
{
    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return route('api.v1.productFeatures.store');
    }
}
