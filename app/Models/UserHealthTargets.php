<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHealthTargets extends Model
{
    use HasFactory;

    protected $table = 'user_health_targets';


    public $timestamps = false;
}
