<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Ticket;
use App\Message;
use App\Ticket_user;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function ticket(){
        return $this->belongsToMany(Ticket::class, 'ticket_users', 'ticket_id', 'user_id')->withTimestamps();
    }

    public function message(){
        return $this->hasMany(Message::class);
    }

    public function ticket_user(){
        return $this->hasMany(Ticket_user::class);
    }

}
