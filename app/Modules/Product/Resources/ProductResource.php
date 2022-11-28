<?php

namespace App\Modules\Product\Resources;

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
        return [
            'id' => $this->id,
            "nested_sub_category_id" => $this->nested_sub_category_id,
            "product_disease_id" => $this->product_disease_id,
            "product_name" => $this->product_name,
            "product_slug" => $this->product_slug,
            "keyword" => $this->keyword,
            "model" => $this->model,
            "discount" => $this->discount,
            "discount_amount" => $this->discount_price,
            "price" => $this->price,
            "description" => $this->description,
            "content" => $this->content,
            "manual" => $this->manual,
            "is_variant" => $this->is_variant,
            "youtube_id" => $this->youtube_id,
            "measurement" => $this->measurement,
            'status' => $this->status,
        ];
    }


    public function getDiscountPrice($price, $discount)
    {
        return ($discount / 100) * $price;
    }
}
