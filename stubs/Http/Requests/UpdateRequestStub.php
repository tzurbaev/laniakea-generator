<?php

declare(strict_types=1);

namespace Stubs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Stubs\Models\ModelStub;

class UpdateRequestStub extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getResource(): ModelStub
    {
        return $this->route('{resource:singular}');
    }
}
