<?php

 namespace Lembarek\Admin\Providers;


use Illuminate\Contracts\Auth\Access\Gate;
use Lembarek\Auth\Models\User;
use Lembarek\Core\Role\Role;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->fullBoot('admin', __DIR__.'/../');
        app('Lembarek\Admin\Kernel');

        $this->definePermissions($gate);

        $gate->define('destory-user', function($loginUser,User $user){
            return $loginUser->isSuperiorThen($user);
        });

        view()->composer('admin::posts.partials.tinymce', 'Lembarek\Admin\ViewComposers\TinyMceComposer');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * define all permissions
     *
     * @return void
     */
    public function definePermissions(Gate $gate)
    {
        $permissions = Role::allPermissions();
        foreach ($permissions as $permission => $value) {
            $gate->define($permission, function(User $user)use($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}
