<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Order
 */
class Order extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'payment_id',
        'status',
    ];

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
        return $this->belongsToMany(Book::class, 'book_orders')->withPivot('quantity');
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

    /**
     * payment
     *
     * @return void
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
