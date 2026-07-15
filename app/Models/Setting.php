<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToUser;

class Setting extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_gstin',
        'bank_name',
        'bank_branch',
        'account_no',
        'ifsc_code',
        'account_holder',
        'qr_code_path',
        'font_path',
        'use_gujarati_font',
    ];
}
