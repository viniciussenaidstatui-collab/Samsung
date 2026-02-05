<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamsungModel extends Model
{
    protected $table = 'samsung';

    protected $fillable = [
        'cor',
        'ano',
        'modelo',
        'aparelho',
    ];

}
