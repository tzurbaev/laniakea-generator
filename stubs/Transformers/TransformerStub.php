<?php

declare(strict_types=1);

namespace Stubs\Transformers;

use Stubs\Models\ModelStub;
use Stubs\Vendor\AbstractTransformer;

class TransformerStub extends AbstractTransformer
{
    public function transform(ModelStub $model): array
    {
        return [
            //
        ];
    }
}
