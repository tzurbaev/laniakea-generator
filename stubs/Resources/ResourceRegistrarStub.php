<?php

declare(strict_types=1);

namespace Stubs\Resources;

use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;
use Stubs\Exceptions\NotFoundExceptionStub;
use Stubs\Repositories\RepositoryStub;

class ResourceRegistrarStub implements ResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind(
            name: '{resource:singular}',
            resource: ResourceStub::class,
            repository: RepositoryStub::class,
            notFoundException: NotFoundExceptionStub::class,
        );
    }
}
