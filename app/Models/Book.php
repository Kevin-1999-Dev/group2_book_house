<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'cover',
        'description',
        'pagecount',
        'price',
    ];

    /**
     * author
     *
     * @return void
     */
    public function author()
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    /**
     * order
     *
     * @return void
     */
    public function order()
    {
        return $this->belongsToMany(Order::class, 'book_orders');
    }
}
