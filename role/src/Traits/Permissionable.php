<?php

namespace Lembarek\Role\Traits;

trait Permissionable
{
         /**
          * return all permissions for a role
          *
          * @return Lembarek\Role\Models\Permission
          */
    public function permissions()
    {
        return $this->belongsToMany('Lembarek\Role\Models\Permission');
    }

        /**
         * check if the role has a permission
         *
         * @param  string  $permission
         * @return boolean
         */
    public function hasPermission($permission)
    {
        foreach ($this->permissions()->get() as $p) {
            if ($p->name == $permission) {
                return true;
            }
        }
        return false;
    }

        /**
         * assign a permission to a role
         *
         * @param  string  $permission
         * @return void
         */
    public function assignPermission($permission)
    {
        $this->permissions()->attach($permission);
    }
}
