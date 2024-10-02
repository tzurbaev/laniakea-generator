<?php

declare(strict_types=1);

namespace Stubs\Actions;

use Stubs\Models\ModelStub;
use Stubs\Repositories\RepositoryStub;

readonly class DestroyActionStub
{
    public function __construct(private RepositoryStub $repository)
    {
        //
    }

    public function destroy(ModelStub $model): void
    {
        $this->repository->delete($model->getKey());
    }
}
