<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Models\ProductFeature;

class DestroyProductFeatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function getProductFeature(): ProductFeature
    {
        return $this->route('productFeature');
    }
}
