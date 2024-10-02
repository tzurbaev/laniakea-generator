<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Resources;

use Laniakea\Resources\Interfaces\ResourceInterface;

class ProductFeaturesResource implements ResourceInterface
{
    public function getFilters(): array
    {
        return [];
    }

    public function getInclusions(): array
    {
        return [];
    }

    public function getSorters(): array
    {
        return [];
    }
}
