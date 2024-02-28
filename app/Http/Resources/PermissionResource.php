<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $roles
 * @property mixed $name
 * @property mixed $id
 */
class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'permissions',
            'attributes' => [
                'id' => $this->id,
                'name' => $this->name,
            ],
            'relationships' => [
                'roles' => [
                    'data' => $this->roles->pluck('id')->toArray()
                ],
            ],
        ];
    }
}
