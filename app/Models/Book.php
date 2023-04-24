<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Library;



class Book extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'info',
        'auther',
        'publishing_house',
        'date',
        'availablity',
        'price',
        'category_id',
        'link',


    ];


    //protected constant $status='accepted','rejected','pending';

    protected $casts=['date'];




    /**
     * Get the category that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * The library that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function library()
    {
        return $this->belongsToMany(Library::class,'book_library');
    }
/**
 * Get the order associated with the Book
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function order()
{
    return $this->hasOne(Order::class,);
}


}
