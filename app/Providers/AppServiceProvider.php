<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use Parsedown;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('datetime', function($expression) {
            return "<?php echo date('y/n/j G:i', strtotime((string)$expression)) ?>";
        });
        Blade::directive('markdownify', function($expression) {
            return "<?php \$a = explode('```', $expression); 
            for (\$i = 0; \$i < count(\$a); \$i += 2) { \$a[\$i] = str_replace(\"\n\", \"  \n\", \$a[\$i]); } 
            echo (new Parsedown())->text(implode('```', \$a)); ?>";
        });
        Blade::directive('mb_excerpt', function($expression, $length = 240){
            return 'Unavailable';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
