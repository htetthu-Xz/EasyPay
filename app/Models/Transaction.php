<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_no',
        'trx_id',
        'user_id',
        'type',
        'amount',
        'source_id',
        'description'
    ];
}
