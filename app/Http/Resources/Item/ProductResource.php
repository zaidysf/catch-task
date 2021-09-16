<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\Brand\DefaultResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brand = collect($this->resource['brand']);

        return [
            'product_id' => $this->resource['product_id'],
            'title' => $this->resource['title'],
            'subtitle' => $this->resource['subtitle'],
            'image' => $this->resource['image'],
            'thumbnail' => $this->resource['thumbnail'],
            'category' => $this->resource['category'],
            'url' => $this->resource['url'],
            'upc' => $this->resource['upc'],
            'gtin14' => $this->resource['gtin14'],
            'created_at' => $this->resource['created_at'],
            'brand' => new DefaultResource($brand),
        ];
    }
}
