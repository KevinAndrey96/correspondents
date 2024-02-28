<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use Illuminate\Http\Request;

class IndexRolesController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
       $this->roleRepository = $roleRepository;
    }


    public function __invoke()
    {
        $roles = $this->roleRepository->getAll();

        return view('roles.index', ['roles' => $roles]);
    }
}
