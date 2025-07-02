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

    public function attack(Monster $target, $damage)
    {
    $actualDamage = max(1, $damage - $target->defense);
        $target->health = max(0, $target->health - $actualDamage);
        return $actualDamage;
    }

    public function gainGold($amount)
    {
        $this->gold += $amount;
    return $this;
    }
}