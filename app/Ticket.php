<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Priority;
use App\State;
use App\Institution;
use App\Message;
use App\Ticket_user;

class Ticket extends Model
{
    public function user(){
        return $this->belongsToMany(User::class, 'ticket_users', 'ticket_id', 'user_id')->withTimestamps();
    }

    public function priority(){
        return $this->belongsTo(Priority::class);
    }

    public function Institution(){
        return $this->belongsTo(Institution::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function message(){
        return $this->hasMany(Message::class);
    }

    public function ticket_user(){
        return $this->hasMany(Ticket_user::class);
    }
    
}
