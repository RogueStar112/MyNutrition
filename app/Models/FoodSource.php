<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodSource extends Model
{
    use HasFactory;

    protected $table = 'food_source';

    protected $guarded = ['id']; 
    
    public $timestamps = false;
    
}
