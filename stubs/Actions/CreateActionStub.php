<?php

declare(strict_types=1);

namespace Stubs\Actions;

use Stubs\Http\Requests\StoreRequestStub;
use Stubs\Models\ModelStub;
use Stubs\Repositories\RepositoryStub;

readonly class CreateActionStub
{
    public function __construct(private RepositoryStub $repository)
    {
        //
    }

    public function create(StoreRequestStub $request): ModelStub
    {
        //
    }
}
