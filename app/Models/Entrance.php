<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrance extends Model {
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['name' , 'house_id' ];


    public function house(){
        return $this->belongsTo(House::class);
    }

    public function floors(){
        return $this->hasMany(Floor::class);
    }
}
