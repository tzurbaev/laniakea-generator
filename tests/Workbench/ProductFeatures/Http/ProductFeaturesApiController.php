<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laniakea\Forms\Interfaces\FormsManagerInterface;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;
use Laniakea\Transformers\TransformationManager;
use Laniakea\Tests\Workbench\ProductFeatures\Actions\CreateProductFeature;
use Laniakea\Tests\Workbench\ProductFeatures\Actions\DestroyProductFeature;
use Laniakea\Tests\Workbench\ProductFeatures\Actions\UpdateProductFeature;
use Laniakea\Tests\Workbench\ProductFeatures\Forms\EditProductFeatureForm;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\DestroyProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\EditProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\ListProductFeaturesRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\StoreProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\UpdateProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\ViewProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Repositories\ProductFeaturesRepository;
use Laniakea\Tests\Workbench\ProductFeatures\Resources\ProductFeaturesResource;
use Laniakea\Tests\Workbench\ProductFeatures\Transformers\ProductFeatureTransformer;

readonly class ProductFeaturesApiController
{
    public function index(
        ListProductFeaturesRequest $request,
        ResourceRequestInterface $requester,
        ResourceManagerInterface $manager,
    ): JsonResponse {
        $paginator = $manager->getPaginator(
            $requester,
            new ProductFeaturesResource(),
            new ProductFeaturesRepository(),
        );

        return (new TransformationManager($paginator, new ProductFeatureTransformer()))
            ->parseInclusions($requester->getInclusions())
            ->respond();
    }

    public function store(StoreProductFeatureRequest $request, CreateProductFeature $action): JsonResponse
    {
        return (new TransformationManager($action->create($request), new ProductFeatureTransformer()))
            ->respond();
    }

    public function show(ViewProductFeatureRequest $request, ResourceRequestInterface $requester): JsonResponse
    {
        return (new TransformationManager($request->getProductFeature(), new ProductFeatureTransformer()))
            ->parseInclusions($requester->getInclusions())
            ->respond();
    }

    public function form(EditProductFeatureRequest $request, FormsManagerInterface $formsManager): JsonResponse
    {
        return response()->json([
            'data' => [
                'form' => $formsManager->getFormData(new EditProductFeatureForm($request->getProductFeature())),
            ],
        ]);
    }

    public function update(UpdateProductFeatureRequest $request, UpdateProductFeature $action): JsonResponse
    {
        $productFeature = $action->update($request, $request->getProductFeature());

        return (new TransformationManager($productFeature, new ProductFeatureTransformer()))
            ->respond();
    }

    public function destroy(DestroyProductFeatureRequest $request, DestroyProductFeature $action): Response
    {
        $action->destroy($request->getProductFeature());

        return response()->noContent();
    }
}
