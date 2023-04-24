<?php

namespace App\Http\Resources;
use App\Http\Resources\UserResource;
use App\Models\Book;


use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{

    public function toArray($request)
    {
        return[
         'id'=>$this->id,
        'name' => $this->name,
        'info' => $this->info,
        'auther' => $this->auther,
        'publishing_house' => $this->publishing_house,
        'date' => $this->date,
        'availablity' => $this->availablity,
        'price' => $this->price,
        'link' => $this->link,
        'category_id' => $this->category_id,


        ];
    }
}
