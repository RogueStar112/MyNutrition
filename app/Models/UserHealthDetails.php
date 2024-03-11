<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHealthDetails extends Model
{
    use HasFactory;

    protected $table = 'user_health_details';

    
    protected $fillable = [
        'weight',
        'height',
        'bmi',
        'bodyfat',
        'last_updated'
    ];

    public $timestamps = false;
}
