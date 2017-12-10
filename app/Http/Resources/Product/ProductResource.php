<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'name' =>$this->name,
          'description' => $this->details,
            'original price' => $this->price,
            'discount' => $this->discount,
            'price after discount' =>round ( (1 -($this->discount/100)) * $this->price ,2) ,
            'stock' => $this->stock == '0' ? 'Out Of Stock' : $this->stock,
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No rating yet',
            'href' => [
                'reviews' => route('reviews.index',$this->id)
            ]
        ];
    }
}
