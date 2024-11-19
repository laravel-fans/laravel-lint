<?php

namespace LaravelFans\Lint;

use Illuminate\Console\Command;

class LintPintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:pint
        {--test}
        {--repair}
        {--config=pint.json}
        {files?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint by pint';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $files = empty($this->argument('files')) ? ['.'] : $this->argument('files');
        $command = "vendor" . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "pint";
        $command .= " --config=" . $this->option('config');
        if ($this->option('test')) {
            $command .= ' --test';
        }
        if ($this->option('repair')) {
            $command .= ' --repair';
        }
        exec(
            $command . ' ' . implode(' ', $files),
            $output,
            $code
        );
        foreach ($output as $line) {
            $this->line($line);
        }
        return $code;
    }
}
