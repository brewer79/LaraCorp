<?php

namespace Corp\Providers;

use Corp\Article;
use Corp\Permission;
use Corp\Menu;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\User;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\PermissionPolicy;
use Corp\Policies\MenuPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'Corp\Model' => 'Corp\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenuPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('VIEW_ADMIN', function($user)
        {
            return $user->canDo('VIEW_ADMIN', false);
        });

        $gate->define('VIEW_ADMIN_ARTICLES', function($user)
        {
            return $user->canDo('VIEW_ADMIN_ARTICLES', false);
        });

        $gate->define('EDIT_USERS', function($user)
        {
            return $user->canDo('EDIT_USERS', false);
        });

        $gate->define('VIEW_ADMIN_MENU', function($user)
        {
            return $user->canDo('VIEW_ADMIN_MENU', false);
        });

     /*   $gate->define('EDIT_MENU', function($user)
        {
            return $user->canDo('EDIT_MENU', false);
        });*/

    }
}
