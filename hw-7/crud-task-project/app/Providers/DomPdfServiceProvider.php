<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dompdf\Dompdf;

class DomPdfServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('dompdf.wrapper', function () {
            return new Dompdf();
        });
    }

    public function boot()
    {
        //
    }
}
