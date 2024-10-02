<?php

declare(strict_types=1);

namespace Laniakea\Generator\Enums;

enum Replacement: string
{
    case NAMESPACE = '{namespace}';
    case RESOURCE_SINGULAR = '{resource:singular}';
    case RESOURCE_SINGULAR_SNAKE = '{resource:singular:snake}';
    case RESOURCE_SINGULAR_UCFIRST = '{resource:singular:ucfirst}';
    case RESOURCE_SINGULAR_WORDS = '{resource:singular:words}';
    case RESOURCE_SINGULAR_WORDS_TITLE = '{resource:singular:words:title}';
    case RESOURCE_PLURAL = '{resource:plural}';
    case RESOURCE_PLURAL_SNAKE = '{resource:plural:snake}';
    case RESOURCE_PLURAL_UCFIRST = '{resource:plural:ucfirst}';
    case RESOURCE_PLURAL_WORDS = '{resource:plural:words}';
    case RESOURCE_PLURAL_WORDS_TITLE = '{resource:plural:words:title}';
}
