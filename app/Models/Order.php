<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'number',
        'status',
        'date',
        'user_id',
        'book_id',

    ];



    public function user()
    {
        return $this->belongsTo(User::class,);
    }




    /**
     * Get the book that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class,);
    }
}
