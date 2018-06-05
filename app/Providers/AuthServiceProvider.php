<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\User;
use App\Account;
use App\Movements;
use App\Policies\AccountPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\AdminPolicy;
use App\Policies\UserPolicy;
use App\Policies\MovementPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Account::class => AccountPolicy::class,
        // User::class => AdminPolicy::class,
        User::class => UserPolicy::class,
        Movement::class => MovementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
