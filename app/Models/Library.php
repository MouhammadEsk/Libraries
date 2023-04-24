<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;


class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'city',
        'street',
        'phone',
        'email',
        'user_id',

    ];





    /**
     * Get the user that owns the Library
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    /**
     * The roles that belong to the Library
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_library');
    }

}

