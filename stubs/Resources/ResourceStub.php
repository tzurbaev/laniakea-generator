<?php

declare(strict_types=1);

namespace Stubs\Resources;

use Laniakea\Resources\Interfaces\ResourceInterface;

class ResourceStub implements ResourceInterface
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
