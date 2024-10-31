<?php

declare(strict_types=1);

namespace Laniakea\Generator\Interfaces;

use Illuminate\Console\Command;
use Laniakea\Generator\Config\GeneratorConfig;

interface GeneratorQuestionInterface
{
    /**
     * Ask additional question before generating files.
     *
     * @param Command         $command
     * @param GeneratorConfig $config
     */
    public function ask(Command $command, GeneratorConfig $config): void;
}
