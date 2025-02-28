<?php

declare(strict_types=1);

namespace Stubs\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laniakea\Forms\Interfaces\FormsManagerInterface;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;
use Laniakea\Transformers\TransformationManager;
use Stubs\Actions\CreateActionStub;
use Stubs\Actions\DestroyActionStub;
use Stubs\Actions\UpdateActionStub;
use Stubs\Forms\EditFormStub;
use Stubs\Http\Requests\DestroyRequestStub;
use Stubs\Http\Requests\EditRequestStub;
use Stubs\Http\Requests\ListRequestStub;
use Stubs\Http\Requests\StoreRequestStub;
use Stubs\Http\Requests\UpdateRequestStub;
use Stubs\Http\Requests\ViewRequestStub;
use Stubs\Repositories\RepositoryStub;
use Stubs\Resources\ResourceStub;
use Stubs\Transformers\TransformerStub;

readonly class ApiControllerStub
{
    public function index(
        ListRequestStub $request,
        ResourceRequestInterface $requester,
        ResourceManagerInterface $manager,
    ): JsonResponse {
        $paginator = $manager->getPaginator(
            $requester,
            new ResourceStub(),
            new RepositoryStub(),
        );

        return (new TransformationManager($paginator, new TransformerStub()))
            ->parseInclusions($requester->getInclusions())
            ->respond();
    }

    public function store(StoreRequestStub $request, CreateActionStub $action): JsonResponse
    {
        return (new TransformationManager($action->create($request), new TransformerStub()))
            ->respond();
    }

    public function show(ViewRequestStub $request, ResourceRequestInterface $requester): JsonResponse
    {
        return (new TransformationManager($request->getResourceModel(), new TransformerStub()))
            ->parseInclusions($requester->getInclusions())
            ->respond();
    }

    public function form(EditRequestStub $request, FormsManagerInterface $formsManager): JsonResponse
    {
        return response()->json([
            'data' => [
                'form' => $formsManager->getFormData(new EditFormStub($request->getResourceModel())),
            ],
        ]);
    }

    public function update(UpdateRequestStub $request, UpdateActionStub $action): JsonResponse
    {
        $model = $action->update($request, $request->getResourceModel());

        return (new TransformationManager($model, new TransformerStub()))
            ->respond();
    }

    public function destroy(DestroyRequestStub $request, DestroyActionStub $action): Response
    {
        $action->destroy($request->getResourceModel());

        return response()->noContent();
    }
}
