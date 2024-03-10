<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHealthLogs extends Model
{
    use HasFactory;

    protected $table = 'user_health_logs';

    public $timestamps = false;
}
