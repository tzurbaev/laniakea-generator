<?php

declare(strict_types=1);

namespace Stubs\Http;

use Illuminate\View\View;
use Laniakea\Forms\Interfaces\FormsManagerInterface;
use Stubs\Forms\CreateFormStub;
use Stubs\Forms\EditFormStub;
use Stubs\Http\Requests\CreateRequestStub;
use Stubs\Http\Requests\EditRequestStub;
use Stubs\Http\Requests\ListRequestStub;

readonly class ControllerStub
{
    public function index(ListRequestStub $request): View
    {
        //
    }

    public function create(CreateRequestStub $request, FormsManagerInterface $formsManager): View
    {
        return view('crud.create', [
            'form' => $formsManager->getFormData(new CreateFormStub()),
        ]);
    }

    public function edit(EditRequestStub $request, FormsManagerInterface $formsManager): View
    {
        return view('crud.edit', [
            'form' => $formsManager->getFormData(new EditFormStub($request->getResource())),
        ]);
    }
}
