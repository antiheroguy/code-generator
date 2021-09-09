<?php

namespace ThomasDeLuck\CodeGenerator;

use Illuminate\Support\ServiceProvider;
use ThomasDeLuck\CodeGenerator\Console\Commands\GenerateCode;

class CodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../templates', 'templates');

        $this->publishes([
            __DIR__ . '/../config/generator.php' => config_path('generator.php'),
            __DIR__ . '/../templates' => resource_path('views/vendor/templates'),
        ], 'code-generator');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCode::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/generator.php',
            'generator'
        );
    }
}
