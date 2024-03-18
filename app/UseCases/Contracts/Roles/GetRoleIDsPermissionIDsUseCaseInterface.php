<?php

namespace App\UseCases\Contracts\Roles;

use Spatie\Permission\Models\Role;

interface GetRoleIDsPermissionIDsUseCaseInterface
{
    public function getRoleIDsPermissionIDs($roleHasPermissionsCollection);
}
