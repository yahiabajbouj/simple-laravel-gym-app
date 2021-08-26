<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\App;

use App\Repositry\IRepositry\{IBase, IExerciseRepositry, IExercisesTypeRepositry, IFoodRepositry, IProgrameRepositry, IProgramExerciseRepositry, IServiceRepositry, ISubscribeRepositry, IUserRepositry};
use App\Repositry\Repositry\{BaseRepositry, ExerciseRepositry, ExercisesTypeRepositry, FoodRepositry, ProgrameRepositry, ProgramExerciseRepositry, ServiceRepositry, SubscribeRepositry, UserRepositry};
use Illuminate\Support\Facades\App;

class RepositryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(IBase::class, BaseRepositry::class);
        App::bind(IExerciseRepositry::class, ExerciseRepositry::class);
        App::bind(IExercisesTypeRepositry::class, ExercisesTypeRepositry::class);
        App::bind(IFoodRepositry::class, FoodRepositry::class);
        App::bind(IProgrameRepositry::class, ProgrameRepositry::class);
        App::bind(IServiceRepositry::class, ServiceRepositry::class);
        App::bind(ISubscribeRepositry::class, SubscribeRepositry::class);
        App::bind(IUserRepositry::class, UserRepositry::class);

        // $this->app->bind(IBase::class, BaseRepositry::class);
        // $this->app->bind(IExerciseRepositry::class, ExerciseRepositry::class);
        // $this->app->bind(IExercisesTypeRepositry::class, ExercisesTypeRepositry::class);
        // $this->app->bind(IFoodRepositry::class, FoodRepositry::class);
    }

    /**
     * Bootstrap services
     * .
     * @return void
     */
    public function boot()
    {
        //
    }
}
