<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict( ! $this->app->isProduction());

        $this->macros();
    }

    private function macros(): void
    {
        Str::macro('overwriteEmpty', function (mixed $string, string $replace = '---') {
            if (is_string($string) && Str::squish($string) === '') {
                return $replace;
            }

            if ( ! $string) {
                return $replace;
            }

            return $string;
        });
    }
}
