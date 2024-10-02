<?php

declare(strict_types=1);

namespace Laniakea\Generator\Console;

use Illuminate\Console\Command;
use Laniakea\Generator\Config\GeneratorConfigBuilder;
use Laniakea\Generator\Enums\OverrideFileAnswer;
use Laniakea\Generator\Generator;
use Laniakea\Generator\Writer;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;

class GenerateLaniakeaResourceCommand extends Command
{
    protected $signature = 'laniakea:generate {resource?} {--namespace=} {--path=}';
    protected $description = 'Generate a new Laniakea resource.';

    /**
     * Generate Laniakea resource files.
     *
     * @param GeneratorConfigBuilder $configBuilder
     * @param Writer                 $writer
     *
     * @return int
     */
    public function handle(GeneratorConfigBuilder $configBuilder, Writer $writer): int
    {
        $config = $configBuilder->getConfig($this);

        $generator = new Generator($config);
        $files = $generator->getFiles();

        if (!count($files)) {
            $this->warn('No files to generate.');

            return 0;
        }

        $this->comment('Generating resource ['.$config->resource->name.'].');
        $this->comment('Root namespace: ['.$config->namespace->getNamespace().'], root path: ['.$config->namespace->getFullPath().'].');

        if (!confirm('Do you want to generate these files ('.count($files).')?')) {
            $this->comment('Aborted.');

            return 0;
        }

        $count = $writer->write($files, function (string $filename): OverrideFileAnswer {
            $value = select(
                label: 'File ['.$filename.'] already exists. Override?',
                options: [
                    OverrideFileAnswer::YES->value => 'Yes',
                    OverrideFileAnswer::NO->value => 'No',
                    OverrideFileAnswer::YES_ALL->value => 'Yes to all',
                    OverrideFileAnswer::NO_ALL->value => 'No to all',
                ],
            );

            return OverrideFileAnswer::from($value);
        });

        $this->info('Resource generated successfully, '.$count.' file'.($count === 1 ? ' was' : 's were').' created.');

        return 0;
    }
}
