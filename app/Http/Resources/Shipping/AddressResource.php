<?php

namespace App\Http\Resources\Shipping;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'street' => $this->resource['street'],
            'postcode' => $this->resource['postcode'],
            'suburb' => $this->resource['suburb'],
            'state' => $this->resource['state'],
        ];
    }
}
