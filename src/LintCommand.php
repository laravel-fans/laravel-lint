<?php

namespace LaravelFans\Lint;

use Illuminate\Console\Command;

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
        if ($this->option('fix')) {
            $code = $this->call('lint:pint', [
                'files' => $this->argument('files'), '--repair' => true
            ]);
        }
        if (!$this->option('fix')) {
            $code = $this->call('lint:pint', [
                'files' => $this->argument('files'), '--test' => true
            ]);
            $code += $this->call('lint:pmd', [
                'files' => $this->argument('files')
            ]);
            $code += $this->call('lint:route');
        }
        return $code;
    }
}
