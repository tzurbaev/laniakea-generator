<?php

declare(strict_types=1);

namespace Stubs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequestStub extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
