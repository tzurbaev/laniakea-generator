<?php

declare(strict_types=1);

namespace Stubs\Forms;

use Stubs\Vendor\AbstractForm;

abstract class AbstractFormStub extends AbstractForm
{
    public function getFields(): array
    {
        return [];
    }

    public function getValues(): array
    {
        return [];
    }

    public function getSections(): array
    {
        return [];
    }
}
