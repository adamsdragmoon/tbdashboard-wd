<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\Agent;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->uuid = Str::uuid();
        });
    }

    /*
        User::create([
            'name' => 'Joker',
            'username' => 'cyberwave',
            'email' => 'cyberwave78@gmail.com',
            'role' => 'superadmin',
            'department' => 'all',
            'agent' => json_encode(['all']),
            'password' => bcrypt('password'),
            ])

        User::create([
            'name' => 'CS Bacan',
            'username' => 'csstaff01',
            'email' => 'csstaff01@gmail.com',
            'role' => 'user',
            'department' => 'cs',
            'agent' => json_encode(['bacan4d', 'bacansports']),
            'password' => bcrypt('password'),
            ])
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role',
        'password',
        'department',
        'agent',
        'maxwd',
        "is_active",
        "isLogin"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent', 'kodeagent');
    }
}
