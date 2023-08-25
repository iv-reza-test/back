<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model {
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['name' , 'street' , 'image'];

    public function entrances(){
        return $this->hasMany(Entrance::class);
    }

}
