<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Actions;

use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\UpdateProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;
use Laniakea\Tests\Workbench\ProductFeatures\Repositories\ProductFeaturesRepository;

readonly class UpdateProductFeature
{
    public function __construct(private ProductFeaturesRepository $repository)
    {
        //
    }

    public function update(UpdateProductFeatureRequest $request, ProductFeature $productFeature): ProductFeature
    {
        //
    }
}
