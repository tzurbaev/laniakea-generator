<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\ProductFeatures\Exceptions;

use Laniakea\Exceptions\BaseHttpException;

class ProductFeatureNotFoundException extends BaseHttpException
{
    public const MESSAGE = 'Product Feature was not found.';
    public const ERROR_CODE = 'product_features.not_found';
    public const HTTP_CODE = 404;
}
