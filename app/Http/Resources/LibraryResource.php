<?php

namespace App\Http\Resources;
use App\Http\Resources\UserResource;
use App\Http\Resources\BookResource;

use App\Models\Library;
use App\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

class LibraryResource extends JsonResource
{

    public function toArray($request)
    {
        return[
         'id'=>$this->id,
        'name' => $this->name,
        'city' => $this->city,
        'phone' => $this->phone,
        'street' => $this->street,
        'email' => $this->email,
        'user' =>new UserResource($this->whenloaded('user')) ,
        'book' =>new BookResource($this->whenloaded('book')) ,


        ];
    }
}
