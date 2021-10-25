<?php

namespace LaravelFans\Lint\Tests;

use Illuminate\Support\Facades\File;

class LintPublishCommandTest extends TestCase
{
    public function testGitNotExists()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::deleteDirectory($laravelPath . '/.git/', true);
        $this->artisan('lint:publish')->run();
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->assertFileExists($laravelPath . '/phpmd.xml');
        $this->assertFileDoesNotExist($laravelPath . '/.git/hooks/pre-commit');
    }

    public function testGitExists()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::makeDirectory($laravelPath . '/.git/hooks/', 0755, true);
        $this->artisan('lint:publish')->run();
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->assertFileExists($laravelPath . '/phpmd.xml');
        $this->assertFileExists($laravelPath . '/.git/hooks/pre-commit');
    }
}
