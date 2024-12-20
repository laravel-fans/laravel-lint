<?php

namespace LaravelFans\Lint\Tests;

use phpmock\MockBuilder;

class LintPmdCommandTest extends TestCase
{
    public function testLintPmdWithoutArgs()
    {
        $builder = new MockBuilder();
        $builder->setNamespace('\\LaravelFans\\Lint')
            ->setName("exec")
            ->setFunction(
                function ($command, &$output, &$code) {
                    $this->assertEquals("vendor/bin/phpmd . text phpmd.xml", $command);
                    $output = [];
                    $code = 1;
                }
            );
        $mock = $builder->build();
        $mock->enable();
        $this->artisan('lint:pmd')->assertExitCode(1);
        $mock->disable();
    }
}
