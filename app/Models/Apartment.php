<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model {
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['name', 'floor_id' ];

    public function floor() {
        return $this->belongsTo(Floor::class);
    }
}
