<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodeagent',
        'namaagent',
        'kodeprovider'
    ];

    public function provider()
    {
        return $this->belongsTo(GameProvider::class);
    }
}

