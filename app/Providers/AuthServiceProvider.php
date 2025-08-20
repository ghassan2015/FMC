<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
 foreach (config('global.permissions') as $group => $permissions) {
            foreach ($permissions as $key => $label) {



            Gate::define($key, function (Admin $auth = null) use ($key) {
                if ($auth === null) {
                $auth = auth('admin')->user();
                }

                return $auth && $auth->hasAbility($key);
            });
            }
        }


    }
}
