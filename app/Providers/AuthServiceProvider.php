<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\{Exercise, ExercisesType, Food, Programe, Service, Subscribe};
use App\Policies\{ExerciesPolicy, ExerciesTypePolicy, FoodPolicy, ProgramePolicy, ServicePolicy, SubscribePolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        Exercise::class => ExerciesPolicy::class,
        ExercisesType::class => ExerciesTypePolicy::class,
        Food::class => FoodPolicy::class,
        Programe::class => ProgramePolicy::class,
        Service::class => ServicePolicy::class,
        Subscribe::class => SubscribePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
    }
}
