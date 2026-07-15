<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use BelongsToUser, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'tax',
        'description',
        'user_id',
    ];

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class, 'product_id', 'id');
    }
}
