<?php

declare(strict_types=1);

namespace Stubs\Repositories;

use Laniakea\Repositories\AbstractRepository;
use Stubs\Models\ModelStub;

class RepositoryStub extends AbstractRepository
{
    protected function getModel(): string
    {
        return ModelStub::class;
    }
}
