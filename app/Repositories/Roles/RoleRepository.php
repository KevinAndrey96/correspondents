<?php

namespace App\Repositories\Roles;

use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return  Role::all();
    }

    public function save(string $name): bool
    {
        Role::create(['name' => $name]);

        return true;
    }

    public function update(Role $role, string $name): bool
    {
        $role->update(['name' => $name]) ;
        $role->save();

        return true;
    }

    public function getRegisterByID(int $id): \Spatie\Permission\Contracts\Role
    {
        return Role::findById($id);
    }


    function assignPermissions(Role $role, $permissionIDs)
    {
        $role->syncPermissions($permissionIDs);
    }
}
