<?php

namespace Ijpatricio\NovaLarastanTool\Services;

use LogicException;
use function base_path;
use function str_after;

class CodeAnalyseService
{
    /**
     * @var \Illuminate\Contracts\Console\Kernel
     */
    private $artisan;

    /**
     * @var array
     */
    private $errors;

    public function __construct(\Illuminate\Contracts\Console\Kernel $artisan)
    {
        $this->artisan = $artisan;
    }

    /**
     * We'll turn the 'artisan code:analyse' command
     *
     * @param string $paths
     *
     * @return array
     * @throws \Exception
     */
    public function handle(string $paths = 'app'): array
    {
        $this->runAnalyseCommand($paths);

        $this->processReportOutput();

        return $this->mapErrorsForJson();
    }

    /**
     * Run the code:analyse command.
     *
     * @param string $paths
     */
    private function runAnalyseCommand(string $paths): void
    {
        $this->artisan->call(
            'code:analyse',
            [
                '--error-format' => 'json',
                '--no-progress' => true,
                '--paths'       => $paths,
            ]
        );
    }

    /**
     * Process the output report.
     *
     * @return mixed
     * @throws \Exception
     */
    private function processReportOutput(): void
    {
        $this->errors = json_decode($this->artisan->output());

        if (json_last_error()) {
            throw new \Exception('Error decoding output from code:analyse command');
        }
    }

    /**
     * Map the output errors for JSON.
     *
     * @return array
     */
    private function mapErrorsForJson(): array
    {
        return collect($this->errors)->mapWithKeys(function ($item, $key) {

            if ($key === 'totals' || $key === 'errors') {
                return [$key => $item];
            }

            if ($key === 'files') {
                $files = [];
                foreach ($item as $filename => $fileReport) {
                    $fileReport->filename = str_after($filename, base_path());
                    $files[] = $fileReport;
                }

                return [$key => $files];
            }

            throw new LogicException('Json structure not coherent!');

        })->all();
    }
}
