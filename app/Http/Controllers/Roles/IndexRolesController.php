<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use App\UseCases\Contracts\Roles\GetRoleIDsPermissionIDsUseCaseInterface;
use Illuminate\Http\Request;

class IndexRolesController extends Controller
{
    private RoleRepositoryInterface $roleRepository;
    private GetRoleIDsPermissionIDsUseCaseInterface $getRoleIDsPermissionIDsUseCase;

    public function __construct(RoleRepositoryInterface $roleRepository, GetRoleIDsPermissionIDsUseCaseInterface $getRoleIDsPermissionIDsUseCase)
    {
       $this->roleRepository = $roleRepository;
       $this->getRoleIDsPermissionIDsUseCase = $getRoleIDsPermissionIDsUseCase;
    }


    public function __invoke()
    {
        $roles = $this->roleRepository->getAll();

        $roleHasPermissionsCollection = $this->roleRepository->getAllRoleHasPermissionRegisters();

        $rolesPermissionsArray = $this->getRoleIDsPermissionIDsUseCase->getRoleIDsPermissionIDs($roleHasPermissionsCollection);

        return view('roles.index', ['roles' => $roles, 'rolesPermissionsArray' => $rolesPermissionsArray]);
    }
}
