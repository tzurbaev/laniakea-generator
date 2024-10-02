<?php

declare(strict_types=1);

namespace Stubs\Actions;

use Stubs\Http\Requests\UpdateRequestStub;
use Stubs\Models\ModelStub;
use Stubs\Repositories\RepositoryStub;

readonly class UpdateActionStub
{
    public function __construct(private RepositoryStub $repository)
    {
        //
    }

    public function update(UpdateRequestStub $request, ModelStub $model): ModelStub
    {
        //
    }
}
