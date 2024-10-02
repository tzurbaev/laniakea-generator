<?php

declare(strict_types=1);

namespace Stubs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRequestStub extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
