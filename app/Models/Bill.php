<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Bill extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'bill_no',
        'customer_name',
        'contact_number',
        'notes',
        'total',
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

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class, 'bill_id', 'id')->whereNull('deleted_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountInWordsAttribute()
    {
        $number = $this->total;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen((string) $no);
        $i = 0;
        $str = [];
        $words = ['0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety'];
        $digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number].
                    ' '.$digits[$counter].$plural.' '.$hundred
                    :
                    $words[floor($number / 10) * 10]
                    .' '.$words[$number % 10].' '
                    .$digits[$counter].$plural.' '.$hundred;
            } else {
                $str[] = null;
            }
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            ' and '.$words[$point / 10].' '.
                  $words[$point = $point % 10].' Paise' : '';

        return trim($result).' Rupees'.$points.' Only';
    }

    public function getWhatsappUrlAttribute()
    {
        if (!$this->contact_number) {
            return '#';
        }

        // Clean the contact number to keep only digits
        $number = preg_replace('/\D/', '', $this->contact_number);

        // Standardize Indian mobile number: if 10 digits, prepend 91
        if (strlen($number) === 10) {
            $number = '91' . $number;
        }

        // If it starts with 0 and is 11 digits, replace leading 0 with 91
        if (strlen($number) === 11 && str_starts_with($number, '0')) {
            $number = '91' . substr($number, 1);
        }

        $signedUrl = \Illuminate\Support\Facades\URL::signedRoute('bill.public.preview', ['id' => $this->id]);

        $message = "Hello {$this->customer_name}, your invoice {$this->bill_no} of Rs. {$this->total} is ready. View and download it here: {$signedUrl}";

        return "https://wa.me/{$number}?text=" . urlencode($message);
    }
}
