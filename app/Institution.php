<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;

class Institution extends Model
{
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
