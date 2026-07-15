<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'tax',
        'description',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class, 'product_id', 'id');
    }
}
