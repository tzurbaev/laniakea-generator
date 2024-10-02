<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\DataTables;

use Virgo\Application\DataTables\AbstractDataTable;

class ProductFeaturesDataTable extends AbstractDataTable
{
    public function getId(): string
    {
        return 'productFeatures';
    }

    public function getUrl(): string
    {
        return route('api.v1.productFeatures.index');
    }

    public function getColumns(): array
    {
        return [];
    }
}
