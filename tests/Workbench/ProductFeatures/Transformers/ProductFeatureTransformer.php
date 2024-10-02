<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Transformers;

use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;
use Virgo\Application\Fractal\AbstractTransformer;

class ProductFeatureTransformer extends AbstractTransformer
{
    public function transform(ProductFeature $productFeature): array
    {
        return [
            //
        ];
    }
}
