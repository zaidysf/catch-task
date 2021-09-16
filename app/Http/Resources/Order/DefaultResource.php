<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Customer\DefaultResource as CustomerDefaultResource;
use App\Http\Resources\Item\DefaultResource as ItemDefaultResource;
use App\Http\Resources\Promo\DiscountResource;
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
        $items = collect($this->resource['items']);
        $discounts = collect($this->resource['discounts']);

        return [
            'order_id' => $this->resource['order_id'],
            'order_date' => $this->resource['order_date'],
            'customer' => new CustomerDefaultResource($this->resource['customer']),
            'items' => [new ItemDefaultResource($items)],
            'discounts' => [new DiscountResource($discounts)],
            'shipping_price' => $this->resource['shipping_price'],
        ];
    }
}
