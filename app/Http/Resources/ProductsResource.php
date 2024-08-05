<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'type' => 'products',
            'attributes' => [
                'id' => $this->id,
                'product_name' => $this->product_name,
                'product_description' => $this->product_description,
                'product_logo' => $this->product_logo,
                'product_commission' => $this->product_commission,
                'client_name' => $this->client_name,
                'client_document' => $this->client_document,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'account_type' => $this->account_type,
                'account_number' => $this->account_number,
                'code' => $this->code,
                'extra' => $this->extra,
                'min_amount' => $this->min_amount,
                'max_amount' => $this->max_amount,
                'priority' => $this->priority,
                'num_jineteo' => $this->num_jineteo,
                'hours' => $this->hours,
                'reassignment_minutes' => $this->reassignment_minutes,
                'com_dis' => $this->com_dis,
                'com_shp' => $this->com_shp,
                'com_sup' => $this->com_sup,
                'fixed_commission' => $this->fixed_commission,
                'giros' => $this->giros,
                'are_default_fields' => $this->are_default_fields,
                'field_names' => $this->field_names,
                'category' => $this->category
            ]
        ];
    }
}
