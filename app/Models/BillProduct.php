<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToUser;


class BillProduct extends Model
{
    use SoftDeletes, BelongsToUser;

    protected $fillable = [
        'bill_id',
        'product_id',
        'unit',
        'size',
        'price',
        'total',
        'user_id',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
