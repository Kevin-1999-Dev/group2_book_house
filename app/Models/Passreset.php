<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Passreset
 */
class Passreset extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'token'
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
}
