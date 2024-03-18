<?php

namespace App\Repositories\Contracts\Roles;

use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function getAll():\Illuminate\Database\Eloquent\Collection|array;
    public function save(string $name): bool;
    public function getRegisterByID(int $id): \Spatie\Permission\Contracts\Role;
    public function update(Role $role, string $name): bool;
    public function assignPermissions(Role $role, $permissionIDs);
    public function getAllRoleHasPermissionRegisters();
    public function getNoBaseRoles();
}
