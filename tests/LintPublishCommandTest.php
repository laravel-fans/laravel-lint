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

    public function testPhpcsExists()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::delete($laravelPath . '/phpcs.xml');
        $this->assertFileDoesNotExist($laravelPath . '/phpcs.xml');
        File::append($laravelPath . '/phpcs.xml', 'phpcs');
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->artisan('lint:publish')->run();
        $this->assertEquals('phpcs', File::get($laravelPath . '/phpcs.xml'));
        $this->assertFileExists($laravelPath . '/phpmd.xml');
        $this->assertFileExists($laravelPath . '/.git/hooks/pre-commit');
    }

    public function testPhpcsNotExists()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::delete($laravelPath . '/phpcs.xml');
        $this->assertFileDoesNotExist($laravelPath . '/phpcs.xml');
        $this->artisan('lint:publish')->run();
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->assertXmlFileEqualsXmlFile(__DIR__ . '/../src/stubs/phpcs.xml', $laravelPath . '/phpcs.xml');
        $this->assertFileExists($laravelPath . '/phpmd.xml');
        $this->assertFileExists($laravelPath . '/.git/hooks/pre-commit');
    }

    public function testPhpmdExists()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::delete($laravelPath . '/phpmd.xml');
        $this->assertFileDoesNotExist($laravelPath . '/phpmd.xml');
        File::append($laravelPath . '/phpmd.xml', 'phpmd');
        $this->assertFileExists($laravelPath . '/phpmd.xml');
        $this->artisan('lint:publish')->run();
        $this->assertEquals('phpmd', File::get($laravelPath . '/phpmd.xml'));
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->assertFileExists($laravelPath . '/.git/hooks/pre-commit');
    }
    public function testPhpmdNotExists()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::delete($laravelPath . '/phpmd.xml');
        $this->assertFileDoesNotExist($laravelPath . '/phpmd.xml');
        $this->artisan('lint:publish')->run();
        $this->assertFileExists($laravelPath . '/phpmd.xml');
        $this->assertXmlFileEqualsXmlFile(__DIR__ . '/../src/stubs/phpmd.xml', $laravelPath . '/phpmd.xml');
        $this->assertFileExists($laravelPath . '/phpcs.xml');
        $this->assertFileExists($laravelPath . '/.git/hooks/pre-commit');
    }
}
