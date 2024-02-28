<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use Illuminate\Http\Request;

class SavePermissionAssignmentsRolesController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function __invoke(Request $request)
    {
        $roleID = $request->input('roleID');
        $permissionIDs = $request->input('permissionIDs');
        $role = $this->roleRepository->getRegisterByID($roleID);
        $this->roleRepository->assignPermissions($role, $permissionIDs);
        $roles = $this->roleRepository->getAll();

        return datatables()->collection($roles)->toJson();
    }
}
