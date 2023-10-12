<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function User() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');    
    }

    public function Source() 
    {
        return $this->belongsTo(User::class, 'source_id', 'id');    
    }
}
