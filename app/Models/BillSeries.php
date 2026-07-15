<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToUser;

class BillSeries extends Model
{
    use BelongsToUser;

    protected $fillable = ['prefix', 'current', 'user_id'];
}
