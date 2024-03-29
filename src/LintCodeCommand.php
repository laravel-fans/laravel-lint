<?php

namespace LaravelFans\Lint;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LintCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:code
        {files?*}
        {--fix : automatic fix}
        {--standard=phpcs.xml : coding standards}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint code files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $bin = $this->option('fix') ? 'phpcbf' : 'phpcs';
        $files = empty($this->argument('files')) ? ['.'] : $this->argument('files');
        $command = "vendor" . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "$bin --standard=";
        exec(
            $command . $this->option('standard') . ' ' . implode(' ', $files),
            $output,
            $code
        );
        foreach ($output as $line) {
            $this->line($line);
        }
        return $code;
    }
}
