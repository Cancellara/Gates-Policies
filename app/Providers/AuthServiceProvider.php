<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\{Post, User};
use App\Policies\PostPolicy;
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

        //Before, regla global. Se pueden ir concatenado condiciones qeu serán usadas en los gates
        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
        //Registrar un gate.
        /*

         Gate::define('update-post', function (User $user, Post $post) {
            return $user->owns($post);
        });
        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->owns($post) && !$post->isPublished();
        */
        Gate::resource('post', PostPolicy::class, [
            'update' => 'updatePost',
            'delete' => 'deletePost',

        ]);
    }
}
