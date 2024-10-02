<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Repositories;

use Laniakea\Repositories\AbstractRepository;
use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;

class ProductFeaturesRepository extends AbstractRepository
{
    protected function getModel(): string
    {
        return ProductFeature::class;
    }
}
