<?php

namespace App\Providers;

use App\Models\Antrian;
use App\Policies\AntrianPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Antrian::class => AntrianPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}