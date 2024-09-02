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
            'type' => 'product',
            'attributes' => [
                'id' => $this->id,
                'product_name' => $this->product_name,
                'product_description' => $this->product_description,
                'product_logo' => getenv('APP_URL').$this->product_logo,
                'product_commission' => $this->product_commission,
                'product_type' => $this->product_type,
                'client_name' => $this->client_name,
                'client_document' => $this->client_document,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'account_type' => $this->account_type,
                'account_number' => $this->account_number,
                'code' => $this->code,
                'extra' => $this->extra,
                'are_default_fields' => $this->are_default_fields,
                'min_amount' => $this->min_amount,
                'max_amount' => $this->max_amount,
                'category' => $this->category
            ]
        ];
    }
}
