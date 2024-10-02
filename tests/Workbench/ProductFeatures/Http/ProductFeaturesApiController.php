<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;
use Laniakea\Tests\Workbench\ProductFeatures\Actions\CreateProductFeatureAction;
use Laniakea\Tests\Workbench\ProductFeatures\Actions\DestroyProductFeatureAction;
use Laniakea\Tests\Workbench\ProductFeatures\Actions\UpdateProductFeatureAction;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\DestroyProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\ListProductFeaturesRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\StoreProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\UpdateProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\ViewProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Repositories\ProductFeaturesRepository;
use Laniakea\Tests\Workbench\ProductFeatures\Resources\ProductFeaturesResource;
use Laniakea\Tests\Workbench\ProductFeatures\Transformers\ProductFeatureTransformer;

readonly class ProductFeaturesController
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

        return fractal($paginator, new ProductFeatureTransformer())
            ->parseIncludes($requester->getInclusions())
            ->respond();
    }

    public function store(StoreProductFeatureRequest $request, CreateProductFeatureAction $action): JsonResponse
    {
        return fractal($action->create($request), new ProductFeatureTransformer())
            ->respond();
    }

    public function show(ViewProductFeatureRequest $request, ResourceRequestInterface $requester): JsonResponse
    {
        return fractal($request->getProductFeature(), new ProductFeatureTransformer())
            ->parseIncludes($requester->getInclusions())
            ->respond();
    }

    public function update(UpdateProductFeatureRequest $request, UpdateProductFeatureAction $action): JsonResponse
    {
        return fractal($action->update($request, $request->getProductFeature()), new ProductFeatureTransformer())
            ->respond();
    }

    public function destroy(DestroyProductFeatureRequest $request, DestroyProductFeatureAction $action): Response
    {
        $action->destroy($request->getProductFeature());

        return response()->noContent();
    }
}
