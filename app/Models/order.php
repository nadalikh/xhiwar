<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'ref_id'];
    public function products(){
        return $this->belongsToMany(product::class)->withPivot('number');
    }
}
