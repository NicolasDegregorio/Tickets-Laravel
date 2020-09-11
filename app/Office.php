<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock;

class Office extends Model
{
    public function stock(){
        return $this->hasMany(Stock::class);
    }
}
