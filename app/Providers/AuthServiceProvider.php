<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-course', function($user, $course) {
          return $user->enrollments->where('course_id', $course->id)->where('role', 'Teacher')->first();
        });
        Gate::define('use-course', function($user, $course) {
          return $user->enrollments->where('course_id', $course->id)->first();
        });
    }
}
