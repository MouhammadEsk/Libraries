<?php

namespace App\Http\Resources;
use App\Http\Resources\UserResource;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return[
         'id'=>$this->id,
        'name' => $this->name,
        'description' => $this->description,
        'book' =>new BookResource($this->whenloaded('book')) ,
        ];
    }
}
