<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountSpin extends Model
{
    protected $table = 'discount_spins';

    protected $fillable = [
        'user_id',
        'coupon_code',
        'discount_percent',
        'prize_label',
        'used',
        'used_at',
        'expires_at'
    ];

    protected $casts = [
        'discount_percent' => 'integer',
        'used' => 'boolean',
        'used_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
