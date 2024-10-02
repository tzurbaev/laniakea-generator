<?php

declare(strict_types=1);

namespace Laniakea\Generator\Enums;

enum OverrideFileAnswer: string
{
    case YES = 'yes';
    case NO = 'no';
    case YES_ALL = 'yes_all';
    case NO_ALL = 'no_all';
}
