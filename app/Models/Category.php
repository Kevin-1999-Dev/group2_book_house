<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * ebook
     *
     * @return void
     */
    public function ebook()
    {
        return $this->belongsToMany(Ebook::class, 'ebook_category');
    }

    /**
     * book
     *
     * @return void
     */
    public function book()
    {
        return $this->belongsToMany(Book::class, 'book_category');
    }
}
