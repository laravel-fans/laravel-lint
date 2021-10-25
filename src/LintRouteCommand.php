<?php

namespace LaravelFans\Lint;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LintRouteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:route
        {--file=auto : route list json file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint routes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $json = $this->getRouteJson();
        $routes = json_decode($json, true);
        foreach ($routes as $route) {
            if ($route['uri'] == '/') {
                continue;
            }
            $this->info($route['uri']);
            if (Str::endsWith($route['uri'], '/')) {
                // https://docs.geostandaarden.nl/api/API-Designrules/#api-48-leave-off-trailing-slashes-from-api-endpoints
                $this->error('API-48: Leave off trailing slashes from API endpoints');
                return 1;
            }
            $tmp = explode('/', ltrim($route['uri'], '/'));
            foreach ($tmp as $piece) {
                // ignore variable
                if (preg_match('/^{[^{]+}$/', $piece)) {
                    continue;
                }
                if (!preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $piece)) {
                    $this->error('user-friendly URL should follow domain rules: '
                        . 'lowercase ASCII letters, digits, and hyphens (a-z, 0–9, -)');
                    return 1;
                }
            }
        }

        return 0;
    }

    private function getRouteJson(): string
    {
        if ($this->option('file') == 'auto') {
            Artisan::call('route:list', ['--json' => true]);
            return Artisan::output();
        }
        return File::get($this->option('file'));
    }
}
