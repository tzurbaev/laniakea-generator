<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Actions;

use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;
use Laniakea\Tests\Workbench\ProductFeatures\Repositories\ProductFeaturesRepository;

readonly class DestroyProductFeature
{
    public function __construct(private ProductFeaturesRepository $repository)
    {
        //
    }

    public function destroy(ProductFeature $productFeature): void
    {
        $this->repository->delete($productFeature->getKey());
    }
}
