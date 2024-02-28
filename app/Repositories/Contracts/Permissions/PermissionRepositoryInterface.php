<?php

namespace App\Repositories\Contracts\Permissions;

use Spatie\Permission\Models\Permission;

interface PermissionRepositoryInterface
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection|array;
    public function save(string $name): bool;
    public function getRegisterByID($id): \Spatie\Permission\Contracts\Permission;
    public function update(Permission $permission, string $name): bool;
    public function assignRoles(Permission $permission, $roleIDs): bool;


}
