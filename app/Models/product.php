<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'country_manufacturer', 'name', 'path', 'price'];
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function orders(){
        return $this->belongsToMany(order::class)->withPivot('number');
    }
}
