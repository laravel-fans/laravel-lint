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
        {files*}
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
        exec(
            'vendor/bin/phpcs --standard=' . $this->option('standard')
            . ' ' . implode(' ', $this->argument('files')),
            $output,
            $code
        );
        foreach ($output as $line) {
            $this->line($line);
        }
        return $code;
    }
}
