<?php

namespace App\Repositories\Permissions;

use App\Repositories\Contracts\Permissions\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Permission::all();
    }

    public function save(string $name): bool
    {
        Permission::create(['name' => $name]);
        return true;
    }

    public function getRegisterByID($id): \Spatie\Permission\Contracts\Permission
    {
        return Permission::findByID($id);
    }

    public function update(Permission $permission, string $name): bool
    {
        $permission->update(['name' => $name]) ;

        return true;
    }

    public function assignRoles(Permission $permission, $roleIDs): bool
    {
        $permission->syncRoles($roleIDs);

        return true;
    }


}
