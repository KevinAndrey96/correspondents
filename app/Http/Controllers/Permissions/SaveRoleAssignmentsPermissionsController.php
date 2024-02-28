<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Permissions\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class SaveRoleAssignmentsPermissionsController extends Controller
{
    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function __invoke(Request $request)
    {
        $permissionID = $request->input('permissionID');
        $roleIDs = $request->input('roleIDs');
        $permission = $this->permissionRepository->getRegisterByID($permissionID);
        $this->permissionRepository->assignRoles($permission, $roleIDs);
        $permissions = $this->permissionRepository->getAll();

        return datatables()->collection($permissions)->toJson();
    }
}
