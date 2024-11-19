<?php

namespace LaravelFans\Lint\Tests;

use phpmock\MockBuilder;

class LintPintCommandTest extends TestCase
{
    public function testLintPintWithoutArgs()
    {
        $builder = new MockBuilder();
        $builder->setNamespace('\\LaravelFans\\Lint')
            ->setName("exec")
            ->setFunction(
                function ($command, &$output, &$code) {
                    $this->assertEquals("vendor/bin/pint --config=pint.json .", $command);
                    $output = [];
                    $code = 0;
                }
            );
        $mock = $builder->build();
        $mock->enable();
        $this->artisan('lint:pint')->assertExitCode(0);
        $mock->disable();
    }
}
