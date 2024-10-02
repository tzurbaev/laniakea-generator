<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Forms;

use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;

class EditProductFeatureForm extends AbstractProductFeatureForm
{
    public function __construct(private readonly ProductFeature $productFeature)
    {
        //
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUrl(): string
    {
        return route('api.v1.productFeatures.update', ['productFeature' => $this->productFeature->getKey()]);
    }

    public function getValues(): array
    {
        return [
            //
        ];
    }
}
