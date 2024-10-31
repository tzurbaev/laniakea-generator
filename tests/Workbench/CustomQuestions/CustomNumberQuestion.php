<?php

declare(strict_types=1);

namespace Laniakea\Tests\Workbench\CustomQuestions;

use Illuminate\Console\Command;
use Laniakea\Generator\Config\GeneratorConfig;
use Laniakea\Generator\Interfaces\GeneratorQuestionInterface;

use function Laravel\Prompts\text;

class CustomNumberQuestion implements GeneratorQuestionInterface
{
    public function ask(Command $command, GeneratorConfig $config): void
    {
        $number = intval(text(
            label: 'Enter any number',
            placeholder: 'For example, 4',
            required: true,
        ));

        $config->addCustomReplacements([
            '{number}' => $number,
        ]);

        $command->comment('Custom number is ['.$number.']');
    }
}
