<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'bill_no',
        'customer_name',
        'notes',
        'total',
    ];

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class, 'bill_id', 'id')->whereNull('deleted_at');
    }
}
