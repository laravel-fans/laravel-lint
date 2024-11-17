<?php

namespace LaravelFans\Lint;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LintPmdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:pmd
        {files?*}
        {--format=text}
        {--ruleset=phpmd.xml}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint by phpmd';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $files = empty($this->argument('files')) ? ['.'] : $this->argument('files');
        $command = "vendor" . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "phpmd ";
        exec(
            $command . implode(' ', $files) . ' ' . $this->option('format') . ' ' . $this->option('ruleset'),
            $output,
            $code
        );
        foreach ($output as $line) {
            $this->line($line);
        }
        return $code;
    }
}
