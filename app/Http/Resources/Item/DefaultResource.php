<?php

namespace App\Http\Resources\Item;

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
        $product = collect($this->resource['product']);

        return [
            'quantity' => $this->resource['quantity'],
            'unit_price' => $this->resource['unit_price'],
            'product' => new ProductResource($product),
        ];
    }
}
