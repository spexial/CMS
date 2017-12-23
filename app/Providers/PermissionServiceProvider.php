<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PermissionService;
use App\Facades\Permission;

class PermissionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('permission',function(){
            return new Permission();
        });

        $this->app->bind('App\Contracts\PermissionContract',function(){
            return new PermissionService();
        });
    }


}
