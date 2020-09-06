<?php

namespace LaravelFans\Lint\Tests;

class LintPublishCommandTest extends TestCase
{
    public function testHandle()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        $this->artisan('lint:publish')->run();
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->assertFileExists($laravelPath . '/.git/hooks/pre-commit');
    }
}
