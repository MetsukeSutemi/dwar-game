<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    public function attack(Player $target, $damage)
    {
    $actualDamage = max(1, $damage - $target->defense);
        $target->health = max(0, $target->health - $actualDamage);
        return $actualDamage;
    }
}
