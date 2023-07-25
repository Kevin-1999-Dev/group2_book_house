<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Cart
 */
class Cart extends Model
{
    use HasFactory;

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * book
     *
     * @return void
     */
    public function book()
    {
        return $this->belongsToMany(Book::class, 'book_orders');
    }

    /**
     * ebook
     *
     * @return void
     */
    public function ebook()
    {
        return $this->belongsToMany(Ebook::class, 'ebook_orders');
    }
}
