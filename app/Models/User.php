<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'google_id', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function billSeries()
    {
        return $this->hasMany(BillSeries::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->billSeries()->create([
                'prefix' => 'B_',
                'current' => 0,
            ]);
        });
    }
}
