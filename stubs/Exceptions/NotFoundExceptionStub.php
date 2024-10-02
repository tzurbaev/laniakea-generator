<?php

declare(strict_types=1);

namespace Stubs\Exceptions;

use Laniakea\Exceptions\BaseHttpException;

class NotFoundExceptionStub extends BaseHttpException
{
    public const MESSAGE = '{resource:singular:words:title} was not found.';
    public const ERROR_CODE = '{resource:plural:snake}.not_found';
    public const HTTP_CODE = 404;
}
