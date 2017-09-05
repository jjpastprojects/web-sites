<?php

namespace Lembarek\Role\Traits;

use Lembarek\Auth\Models\User;
use Lembarek\Role\Models\Role;

trait Roleable
{
    /**
    * return all roles for a user
    *
    * @return Lembarek\Role\Models\Role
    */
    public function roles()
    {
        return $this->belongsToMany('Lembarek\Role\Models\Role');
    }

    /**
    * check if the user has a role
    *
    * @param  string  $role
    * @return boolean
    */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
    * assign a role to a user
    *
    * @param  string  $role
    * @return void
    */
    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }

    /**
     * check if the current user is supurior then $user
     *
     * @param  User  $user
     * @return boolean
     */
    public function isSuperiorThen($user)
    {
        if( ! $this->maxRole()) return false;
        if( ! $user->maxRole()) return true;
        return $this->maxRole()->order > $user->maxRole()->order;
    }

    /**
     * return the most supurior role for a user
     *
     * @return Lembarek\Role\Models\Role
     */
    public function maxRole()
    {
        $roles = $this->roles;
        $r = $roles->first();

        foreach ($roles as $role){
            if($role->order > $r->order)
                $r = $role;
        }

        return $r;
    }

    /**
     * can add a role
     *
     * @param  Role  $role
     * @return boolean
     */
    public function canAddRole(Role $role)
    {
        return $this->maxRole()->order >= $role->order;
    }

    /**
     * can delete a role
     *
     * @param  User $user
     * @return boolean
     */
    public function canDeleteRole(User $user)
    {
        return $this->maxRole()->order >= $user->maxRole()->order;
    }

    /**
     * return all available role for this user
     *
     * @param User $user
     * @return array
     */
    public function getRolesFor(User $user)
    {

        $userRoles = $user->roles()->get();

        $roles  = Role::where('order', '<=', $this->maxRole()->order);

        foreach ($userRoles as $role) {
            $roles = $roles->where('name', '!=', $role->name);
        }

        return $roles->get();
    }

    /**
     * check if user has permission
     *
     * @param  string  $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        foreach($this->roles as $role){
            if($role->hasPermission($permission))
                return true;
        }
        return false;
    }

}
