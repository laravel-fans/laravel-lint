<?php

namespace LaravelFans\Lint;

use Illuminate\Support\ServiceProvider;

class LintServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LintCommand::class,
                LintCodeCommand::class,
                LintPintCommand::class,
                LintPmdCommand::class,
                LintPhpcsCommand::class,
                LintPublishCommand::class,
                LintRouteCommand::class,
                LintStagedCommand::class,
            ]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            LintCheckCommand::class,
            LintPublishCommand::class,
            LintRouteCommand::class,
            LintStagedCommand::class,
        ];
    }
}
