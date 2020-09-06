<?php

namespace LaravelFans\Lint\Tests;

use LaravelFans\Lint\LintServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LintServiceProvider::class,
        ];
    }
}
