<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Actions;

use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\StoreProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;
use Laniakea\Tests\Workbench\ProductFeatures\Repositories\ProductFeaturesRepository;

readonly class CreateProductFeatureAction
{
    public function __construct(private ProductFeaturesRepository $repository)
    {
        //
    }

    public function create(StoreProductFeatureRequest $request): ProductFeature
    {
        //
    }
}
