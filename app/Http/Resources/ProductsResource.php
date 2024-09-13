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
                'productName' => $this->product_name,
                'productDescription' => $this->product_description,
                'productLogo' => getenv('APP_URL').$this->product_logo,
                'productCommission' => $this->product_commission,
                'productType' => $this->product_type,
                'clientName' => $this->client_name,
                'clientDocument' => $this->client_document,
                'phoneNumber' => $this->phone_number,
                'email' => $this->email,
                'accountType' => $this->account_type,
                'accountNumber' => $this->account_number,
                'code' => $this->code,
                'extra' => $this->extra,
                'areDefaultFields' => $this->are_default_fields,
                'fieldNames' => $this->field_names,
                'minAmount' => $this->min_amount,
                'maxAmount' => $this->max_amount,
                'category' => $this->category
            ]
        ];
    }
}
