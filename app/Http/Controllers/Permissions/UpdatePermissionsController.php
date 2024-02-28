<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Permissions\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class UpdatePermissionsController extends Controller
{
    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function __invoke(Request $request)
    {
        $name = $request->input('name');
        $permissionID = $request->input('id');
        $permission = $this->permissionRepository->getRegisterByID($permissionID);
        $this->permissionRepository->update($permission, $name);
        $permissions = $this->permissionRepository->getAll();

        return datatables()->collection($permissions)->toJson();
    }
}
