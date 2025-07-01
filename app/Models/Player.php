<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players'; // Говорим, что это таблица players
    
    // Какие поля можно заполнять
    protected $fillable = [
        'name', 
        'health',
        'max_health',
        'level',
        'experience',
        'gold',
        'attack',
        'defense'
    ];
}