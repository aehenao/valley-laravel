<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación con posts: Uno a Muchos
     * @author: Andres S. Henao
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
     * Relación con comentarios: Uno a Muchos
     * @author: Andres S. Henao
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
