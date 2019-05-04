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
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function hasRole($role)
    {
        return $this->role()->where('name', $role)->exists();
    }

    public function Addresses()
    {
        return $this->hasMany('App\Address', 'user_id', 'id');
    }

    public function Orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'id');
    }

    public function Tickets()
    {
        return $this->hasMany('App\Ticket', 'user_id', 'id');
    }
}
