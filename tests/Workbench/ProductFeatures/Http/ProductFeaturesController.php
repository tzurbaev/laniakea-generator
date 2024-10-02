<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Laniakea\Forms\Interfaces\FormsManagerInterface;
use Laniakea\Tests\Workbench\ProductFeatures\Forms\CreateProductFeatureForm;
use Laniakea\Tests\Workbench\ProductFeatures\Forms\EditProductFeatureForm;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\CreateProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\EditProductFeatureRequest;
use Laniakea\Tests\Workbench\ProductFeatures\Http\Requests\ListProductFeaturesRequest;

readonly class ProductFeaturesController
{
    public function index(ListProductFeaturesRequest $request): View
    {
        //
    }

    public function create(CreateProductFeatureRequest $request, FormsManagerInterface $formsManager): View
    {
        return view('crud.create', [
            'form' => $formsManager->getFormData(new CreateProductFeatureForm()),
        ]);
    }

    public function edit(EditProductFeatureRequest $request, FormsManagerInterface $formsManager): View
    {
        return view('crud.edit', [
            'form' => $formsManager->getFormData(new EditProductFeatureForm($request->getProductFeature())),
        ]);
    }

    public function form(EditProductFeatureRequest $request, FormsManagerInterface $formsManager): JsonResponse
    {
        return response()->json([
            'data' => [
                'form' => $formsManager->getFormData(new EditProductFeatureForm($request->getProductFeature())),
            ],
        ]);
    }
}
