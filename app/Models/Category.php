<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
/**
 * Get all of the book for the Category
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function book()
{
    return $this->hasMany(Book::class,);
}

}
