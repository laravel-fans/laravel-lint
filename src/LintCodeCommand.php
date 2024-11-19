<?php

namespace LaravelFans\Lint;

use Illuminate\Console\Command;

class LintCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:code
        {files?*}
        {--fix : automatic fix}';

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
        $code = $this->call('lint:phpcs', [
            'files' => $this->argument('files'), '--fix' => $this->option('fix')
        ]);
        if (!$this->option('fix')) {
            $code += $this->call('lint:pmd', [
                'files' => $this->argument('files')
            ]);
        }
        return $code;
    }
}
