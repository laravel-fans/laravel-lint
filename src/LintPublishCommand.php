<?php

namespace LaravelFans\Lint;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LintPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Lint config files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $basePath = $this->laravel->basePath();

        File::copy(__DIR__ . '/stubs/phpcs.xml', $basePath . '/phpcs.xml');
        File::copy(__DIR__ . '/stubs/phpmd.xml', $basePath . '/phpmd.xml');
        if (File::exists($basePath . '/.git/hooks')) {
            File::copy(__DIR__ . '/stubs/git-pre-commit', $basePath . '/.git/hooks/pre-commit');
            File::chmod($basePath . '/.git/hooks/pre-commit', 0755);
        }

        $this->info('published successfully.');
    }
}
