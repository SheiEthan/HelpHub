<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function publi_likes(){
        return $this->hasMany(
            Liker_publi::class,
            'id_user'
        );
    }

    public function likes(){
        return $this->hasMany(
            Liker::class,
            'id_user'
        );
    }

    public function signals(){
        return $this->hasMany(
            Signaler::class,
            'id_user'
        );
    }

    public function historiques(){
        return $this->hasMany(
            Historique::class,
            'id_user'
        );
    }

    public function utilisateur(){
        return $this->belongsTo(
            Utilisateur::class,
            'id',
            'id_user'
        );
    }

    public function association(){
        return $this->belongsTo(
            Association::class,
            'id',
            'id_user'
        );
    }

    public function alerte(){
        return $this->belongsTo(
            Alerte::class,
            'id',
            'id_user'
        );
    }




}
