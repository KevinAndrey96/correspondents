<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use Illuminate\Http\Request;

class UpdateRolesController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function __invoke(Request $request)
    {
        $name = $request->input('name');
        $roleID = $request->input('id');
        $role = $this->roleRepository->getRegisterByID($roleID);
        $this->roleRepository->update($role, $name);
        $roles = $this->roleRepository->getAll();

        return datatables()->collection($roles)->toJson();
    }
}
