<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Grab extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($grab) {
            $grab->uuid = Str::uuid();
        });
    }

    protected $guarded = [
        'id',
        'uuid'
    ];

    
    public static function getGrabbedDataByUuid($uuid) {
        $process_data = Grab::all();
        return $process_data->firstWhere('uuid', $uuid);
    }
}
