<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model {
    use HasFactory;

    protected $guarded = [];


    public function entrance(){
        return $this->belongsTo(House::class);
    }
    public function apartments(){
        return $this->hasMany(Apartment::class);
    }

}
