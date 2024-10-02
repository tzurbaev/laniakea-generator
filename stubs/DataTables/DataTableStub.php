<?php

declare(strict_types=1);

namespace Stubs\DataTables;

use Stubs\Vendor\AbstractDataTable;

class DataTableStub extends AbstractDataTable
{
    public function getId(): string
    {
        return '{resource:plural}';
    }

    public function getUrl(): string
    {
        return route('api.v1.{resource:plural}.index');
    }

    public function getColumns(): array
    {
        return [];
    }
}
