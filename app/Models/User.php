<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'twofactor',
        'address',
        'image',
        'role',
        'active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->image = 'default.png';
            $query->role = false;
            $query->active = true;
        });
    }

    /**
     * ebook
     *
     * @return void
     */
    public function ebook()
    {
        return $this->belongsToMany(Ebook::class, 'user_ebook');
    }

    /**
     * order
     *
     * @return void
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * passreset
     *
     * @return void
     */
    public function passreset()
    {
        return $this->hasMany(Passreset::class);
    }
}
