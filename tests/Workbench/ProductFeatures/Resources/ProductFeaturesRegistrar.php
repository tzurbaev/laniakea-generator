<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Resources;

use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;
use Laniakea\Tests\Workbench\ProductFeatures\Exceptions\ProductFeatureNotFoundException;
use Laniakea\Tests\Workbench\ProductFeatures\Repositories\ProductFeaturesRepository;

class ProductFeaturesRegistrar implements ResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind(
            name: 'productFeature',
            resource: ProductFeaturesResource::class,
            repository: ProductFeaturesRepository::class,
            notFoundException: ProductFeatureNotFoundException::class,
        );
    }
}
