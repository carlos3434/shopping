<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function usuarios()
    {
        return $this->hasMany('App\Models\Car','car_id');
    }
}
