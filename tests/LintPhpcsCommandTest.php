<?php

namespace LaravelFans\Lint\Tests;

use Illuminate\Support\Facades\File;
use phpmock\MockBuilder;
use phpmock\functions\FixedValueFunction;

class LintPhpcsCommandTest extends TestCase
{
    public function testLintPhpcsWithoutArgs()
    {
        $builder = new MockBuilder();
        $builder->setNamespace('\\LaravelFans\\Lint')
            ->setName("exec")
            ->setFunction(
                function ($command, &$output, &$code) {
                $this->assertEquals("vendor/bin/phpcs --standard=phpcs.xml .", $command);
                $output = [];
                $code = 0;
            });
        $mock = $builder->build();
        $mock->enable();
        $this->artisan('lint:phpcs')->assertExitCode(0);
        $mock->disable();
    }
}
