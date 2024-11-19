<?php

namespace LaravelFans\Lint;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint
        {files?*}
        {--fix : automatic fix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check code style of code(including tests and routes)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $code = $this->call('lint:phpcs', [
            'files' => $this->argument('files'), '--fix' => $this->option('fix')
        ]);
        if (!$this->option('fix')) {
            $code += $this->call('lint:pmd', [
                'files' => $this->argument('files')
            ]);
            $code += $this->call('lint:route');
        }
        return $code;
    }
}
