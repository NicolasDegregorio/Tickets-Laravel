<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock;


class Category extends Model
{
    public function stock(){
        return $this->hasMany(Stock::class);
    }
}
