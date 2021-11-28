<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'lastname'=>$this->ln,
            'firstname'=>$this->fn,
            'surname'=>$this->sn,
            'code'=>$this->code,
            'phone'=>$this->phone,
            'isFavourite'=>$this->is_favorite,
        ];
    }
}
