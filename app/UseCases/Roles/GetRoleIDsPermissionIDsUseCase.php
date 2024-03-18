<?php

namespace App\UseCases\Roles;

use App\UseCases\Contracts\Roles\GetRoleIDsPermissionIDsUseCaseInterface;
use Spatie\Permission\Models\Role;

class GetRoleIDsPermissionIDsUseCase implements GetRoleIDsPermissionIDsUseCaseInterface
{
    public function getRoleIDsPermissionIDs($roleHasPermissionsCollection)
    {
        $rolesPermissionsArray = array();
        $roleNames = array();
        $permissionIDs = array();

        foreach ($roleHasPermissionsCollection as $role) {
            foreach ($role->permissions as $permission) {
                array_push($roleNames, $role->name);
                array_push($permissionIDs, $permission->id);
            }
        }

        $rolesPermissionsArray = [
            'roleNames' => json_encode($roleNames),
            'permissionIDs' => json_encode($permissionIDs)
        ];

        return $rolesPermissionsArray;
    }
}
