<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Permissions\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class StorePermissionsController extends Controller
{
    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function __invoke(Request $request)
    {
        $name = $request->input('name');
        $this->permissionRepository->save($name);
        $permissions = $this->permissionRepository->getAll();

        return datatables()->collection($permissions)->toJson();
    }
}
