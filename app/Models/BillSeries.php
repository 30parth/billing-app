<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BillSeries extends Model
{
    protected $fillable = ['prefix', 'current', 'user_id'];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->user_id = Auth::user()->id;
    //     });

    //     static::updating(function ($model) {
    //         $model->user_id = Auth::user()->id;
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
