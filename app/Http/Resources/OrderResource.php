<?php

namespace App\Http\Resources;
use App\Http\Resources\UserResource;

use App\Models\User;
use App\Models\Book;


use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        return[
         'id'=>$this->id,
        'number' => $this->number,
        'status' => $this->status,
        'date' => $this->date,


        'user' =>new UserResource($this->whenloaded('user')) ,
        'book' =>new BookResource($this->whenloaded('book')),


        ];
    }
}
