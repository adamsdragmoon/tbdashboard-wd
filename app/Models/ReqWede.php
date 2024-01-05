<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class ReqWede extends Model
{
    use HasFactory;
    // use Sluggable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($request) {
            $request->uuid = Str::uuid();
        });
    }

    protected $guarded = [
        'id',
        'uuid'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }
}
