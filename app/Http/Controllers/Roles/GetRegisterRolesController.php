<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class GetRegisterRolesController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function __invoke(int $id)
    {
        $role = $this->roleRepository->getRegisterByID($id);

        return (new RoleResource($role))
            ->additional(['meta' => ['all_permissions' => Permission::all()->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            })->toArray()]]);
    }

}
