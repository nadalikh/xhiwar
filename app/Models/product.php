<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'country_manufacturer', 'name', 'path'];
    public function category(){
        return $this->hasone(category::class);
    }
}
