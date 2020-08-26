<?php
namespace App\Permissions;

use App\Permission;
use App\Role;

trait UserRolesAndPermissionsTrait {
    
    public function hasRole(...$roles) 
    {
       foreach($roles as $role) {
           if($this->roles->contains('slug', $role)) {
               return true;
           }
       }
       return false;       
    }

    public function hasPermission(...$permissions)
    {
        foreach($permissions as $permission) {
            if($this->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionThroughRole($permission) 
    {
        foreach($permission->roles as $role) {
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function getPermission($permission)
    {
        return  $this->hasPermissionThroughRole($permission) || (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    public function getAllPermission(array $permissions)
    {
        return \App\Permission::whereIn('slug', $permissions)->get();
    }

    public function givePermission(...$permission)
    {
        $permissions = $this->getAllPermission($permission);
        if($permissions === null)
        {
            return $this;
        }  
        $this->permissions()->saveMany($permissions);
        return $this; 
    }

    public function modifyPermission(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermission($permissions);
    }

    public function removePermission(...$permission)
    {
        $permissions = $this->getAllPermission($permission);
        $this->permissions()->detach($permissions);
        return $this;
    }
}