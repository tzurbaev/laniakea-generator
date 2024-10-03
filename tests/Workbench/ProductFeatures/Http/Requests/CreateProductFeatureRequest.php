<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductFeatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
