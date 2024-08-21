<?php

namespace Modules\Ad\Transformers;

use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;


class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'price' => $this->price,
            'brand_id' => $this->brand_id,
            'featured' => $this->featured,
            'region' => $this->region,
            'status' => $this->status,
            'country' => $this->country,
            'is_smart_price' => $this->is_smart_price,
            'smart_price' => $this->smart_price,
            'total_views' => $this->total_views,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'created_at' => $this->created_at->diffForHumans(),
            'productCustomFields' => $this->whenLoaded('productCustomFields'),
            'size' => $this->whenLoaded('size'),
        ];
    }
}
