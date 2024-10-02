<?php

declare(strict_types=1);

namespace Stubs\Forms;

use Stubs\Models\ModelStub;

class EditFormStub extends AbstractFormStub
{
    public function __construct(private readonly ModelStub $model)
    {
        //
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUrl(): string
    {
        return route('api.v1.{resource:plural}.update', ['{resource:singular}' => $this->model->getKey()]);
    }
}
