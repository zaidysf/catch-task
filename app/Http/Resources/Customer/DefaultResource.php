<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\Shipping\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shippingAddress = collect($this->resource['shipping_address']);

        return [
            'customer_id' => $this->resource['customer_id'],
            'first_name' => $this->resource['first_name'],
            'last_name' => $this->resource['last_name'],
            'email' => $this->resource['email'],
            'phone' => $this->resource['phone'],
            'shipping' => new AddressResource($shippingAddress),
        ];
    }
}
