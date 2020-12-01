<?php

namespace LaravelFans\Lint\Tests;

use Illuminate\Support\Facades\File;

class LintRouteCommandTest extends TestCase
{
    public function testBadRoute()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::put($laravelPath . '/route.json', json_encode([
            [
                'method' => 'GET',
                'uri' => 'user/',
            ],
        ]));
        $this->artisan('lint:route', ['--file' => $laravelPath . '/route.json'])
            ->assertExitCode(1);

        File::put($laravelPath . '/route.json', json_encode([
            [
                'method' => 'GET',
                'uri' => 'api/user/',
            ],
        ]));
        $this->artisan('lint:route', ['--file' => $laravelPath . '/route.json'])
            ->assertExitCode(1);

        File::put($laravelPath . '/route.json', json_encode([
            [
                'method' => 'GET',
                'uri' => 'user_profile',
            ],
        ]));
        $this->artisan('lint:route', ['--file' => $laravelPath . '/route.json'])
            ->assertExitCode(1);
    }

    public function testGoodRoute()
    {
        $laravelPath = __DIR__ . '/../vendor/orchestra/testbench-core/laravel';
        File::put($laravelPath . '/route.json', json_encode([
            [
                'method' => 'GET',
                'uri' => '/',
            ],
            [
                'method' => 'GET',
                'uri' => 'api/user',
            ],
            [
                'method' => 'GET',
                'uri' => '/user',
            ],
            [
                'method' => 'GET|HEAD',
                'uri' => 'api/photos/{photo}/comments/{comment}/edit',
            ],
            [
                'method' => 'GET|HEAD',
                'uri' => 'api/photos/{photo_id}/comments/{id}',
            ],
        ]));
        $this->artisan('lint:route', ['--file' => $laravelPath . '/route.json'])
            ->assertExitCode(0);
    }
}
