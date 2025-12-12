<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'category',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'menu_item_id');
    }
}