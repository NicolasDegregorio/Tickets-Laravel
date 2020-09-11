<?php

namespace App;
use App\Office;
use App\Category;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
