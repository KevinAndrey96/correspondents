<?php

namespace App\UseCases\Roles;

use App\UseCases\Contracts\Roles\SavePermissionAssignmentsRolesUseCaseInterface;



class SavePermissionAssignmentsRolesUseCase implements SavePermissionAssignmentsRolesUseCaseInterface
{
    private SavePermissionAssignmentsRolesUseCaseInterface $savePermissionAssignmentsRolesUseCase;

    public function __invoke(SavePermissionAssignmentsRolesUseCaseInterface $savePermissionAssignmentsRolesUseCase)
    {
        $this->savePermissionAssignmentsRolesUseCase = $savePermissionAssignmentsRolesUseCase;
    }



}
