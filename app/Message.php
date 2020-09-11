<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Ticket;

class Message extends Model
{
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
