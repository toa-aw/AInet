<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\User;
use App\Account;
use App\Movement;
use App\Document;
use App\Policies\AccountPolicy;
use App\Policies\AdminPolicy;
use App\Policies\UserPolicy;
use App\Policies\MovementPolicy;
use App\Policies\DocumentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Account::class => AccountPolicy::class,
        User::class => UserPolicy::class,
        Movement::class => MovementPolicy::class,
        Document::class => DocumentPolicy::class,
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
