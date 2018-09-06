<?php

namespace Ijpatricio\NovaLarastanTool\Services;

use LogicException;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class FileContentsIntervalResolver
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @var int
     */
    private $errorLine;

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     * @var Collection
     */
    private $fileLines;

    /**
     * AssetController constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;

        $this->fileLines = collect();
    }

    /**
     * Resolve the contents of the provided file.
     *
     * @param string $relativeFilePath
     * @param int $errorLine
     * @return string
     */
    public function resolveIntervalFor(string $relativeFilePath, int $errorLine, int $span = 5): array
    {
        $this->filePath = base_path($relativeFilePath);

        $this->errorLine = $errorLine;

        $this->hydrateFileLines();

        return [
            'data' => [
                'content'       => $this->resolveFileInterval($span),
                'first_line'    => $errorLine - $span,
                'line_span'     => $span,
            ]
        ];
    }

    /**
     * Hydrates the file lines collection
     *
     * @throws LogicException
     */
    private function hydrateFileLines(): void
    {
        if ($file = fopen($this->filePath, "r")) {
            while (!feof($file)) {
                $this->fileLines->push(fgets($file));
            }

            fclose($file);
        } else {
            throw new LogicException('Unable to open file!');
        }
    }

    /**
     * Resolve a given interval from the content
     *
     * @param int $span
     * @return string
     */
    private function resolveFileInterval($span): string
    {
        $errorLineIndex = $this->errorLine - 1;

        $bottomLimitIndex = max(0, $errorLineIndex - $span);

        $howManyLines = $span * 2;

        return $this->fileLines
            ->splice($bottomLimitIndex, $howManyLines)
            ->reduce(function ($carry, $item) {
                return $carry . $item;
            }, '');
    }
}
