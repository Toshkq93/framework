<?php

namespace Core\Loaders;

use Exception;

class ArrayLoader implements LoaderInterface
{
    protected $folder;
    protected $files;

    public function __construct(string $folder)
    {
        $this->folder = $folder;
        $this->initFiles();
    }

    public function parse()
    {
        $parsedFiles = [];
        foreach ($this->files as $namespace => $path) {
            try {
                if (is_file($path)) {
                    $parsedFiles[$namespace] = require $path;
                }
            } catch (Exception $exception) {

            }
        }

        return $parsedFiles;
    }

    /**
     * @return void
     */
    protected function initFiles(): void
    {
        $files = array_diff(scandir($this->folder), array('..', '.'));

        foreach ($files as $file) {
            $filePath = $this->folder . DIRECTORY_SEPARATOR . $file;
            $fileInfo = pathinfo($filePath);

            $this->files[$fileInfo['filename']] = $filePath;
        }
    }
}