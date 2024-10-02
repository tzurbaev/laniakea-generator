<?php

declare(strict_types=1);

namespace Stubs\Forms;

class CreateFormStub extends AbstractFormStub
{
    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return route('api.v1.{resource:plural}.store');
    }
}
