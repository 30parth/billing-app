<?php

namespace App\Traits;

use App\Models\Scopes\UserScope;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    /**
     * Boot the BelongsToUser trait for the model.
     */
    public static function bootBelongsToUser(): void
    {
        static::addGlobalScope(new UserScope);

        static::creating(function ($model) {
            if (Auth::check() && !$model->user_id) {
                $model->user_id = Auth::user()->id;
            }
        });

        static::updating(function ($model) {
            if (Auth::check() && !$model->user_id) {
                $model->user_id = Auth::user()->id;
            }
        });
    }

    /**
     * Get the user that owns the model.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
