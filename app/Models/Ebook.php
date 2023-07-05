<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
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
        'link',
    ];

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_ebook');
    }

    /**
     * author
     *
     * @return void
     */
    public function author()
    {
        return $this->belongsToMany(Author::class, 'ebook_author');
    }

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'ebook_category');
    }

    /**
     * payment
     *
     * @return void
     */
    public function payment()
    {
        return $this->belongsToMany(Payment::class, 'ebook_payment');
    }

    /**
     * order
     *
     * @return void
     */
    public function order()
    {
        return $this->belongsToMany(Order::class, 'ebook_order');
    }
}
