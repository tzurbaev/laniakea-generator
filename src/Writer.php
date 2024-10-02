<?php

declare(strict_types=1);

namespace Laniakea\Generator;

use Laniakea\Generator\Enums\OverrideFileAnswer;

readonly class Writer
{
    /**
     * Write given files to the filesystem.
     * If the target directory does not exist, it will be created.
     * If the target file already exists, the user will be prompted to override it (if $fileExistsCallback provided).
     *
     * @param array         $files
     * @param callable|null $fileExistsCallback
     *
     * @return int
     */
    public function write(array $files, ?callable $fileExistsCallback = null): int
    {
        $overrideFileAnswer = null;

        return collect($files)->sum(function (array $file) use ($fileExistsCallback, &$overrideFileAnswer) {
            if (!$this->directoryExists($file['target']['directory'])) {
                $this->createDirectory($file['target']['directory'], 0755, true);
            }

            if (!$this->canOverrideFile($file['target']['path'], $fileExistsCallback, $overrideFileAnswer)) {
                return 0;
            }

            $this->writeFile($file['target']['path'], $file['contents']);

            return 1;
        });
    }

    /**
     * Check if the given directory exists.
     *
     * @param string $directory
     *
     * @return bool
     */
    protected function directoryExists(string $directory): bool
    {
        return is_dir($directory);
    }

    /**
     * Create a directory.
     *
     * @param string $directory
     * @param int    $permissions
     * @param bool   $recursive
     */
    protected function createDirectory(string $directory, int $permissions, bool $recursive): void
    {
        mkdir($directory, $permissions, $recursive);
    }

    /**
     * Write contents to a file.
     *
     * @param string $path
     * @param string $contents
     */
    protected function writeFile(string $path, string $contents): void
    {
        file_put_contents($path, $contents);
    }

    /**
     * Check if the file can be overridden.
     *
     * @param string        $path
     * @param callable|null $fileExistsCallback
     * @param bool|null     $overrideFileAnswer
     *
     * @return bool
     */
    protected function canOverrideFile(string $path, ?callable $fileExistsCallback, bool|null &$overrideFileAnswer): bool
    {
        if (!file_exists($path)) {
            return true;
        } elseif (is_null($fileExistsCallback)) {
            return false;
        } elseif (!is_null($overrideFileAnswer)) {
            return $overrideFileAnswer;
        }

        $answer = $fileExistsCallback($path);

        if ($answer === OverrideFileAnswer::YES) {
            return true;
        } elseif ($answer === OverrideFileAnswer::NO) {
            return false;
        } elseif ($answer === OverrideFileAnswer::YES_ALL) {
            $overrideFileAnswer = true;

            return true;
        }

        $overrideFileAnswer = false;

        return false;
    }
}
