<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonsterSeeder extends Seeder
{
    public function run()
{
    DB::table('monsters')->insert([
        [
            'name' => 'Гоблин',
            'health' => 30,
            'max_health' => 30,
            'attack' => 8,
            'defense' => 3,
            'gold_reward' => 15,
            'image' => 'goblin.png'
        ],
        [
            'name' => 'Орк',
            'health' => 50,
            'max_health' => 50,
            'attack' => 12,
            'defense' => 5,
            'gold_reward' => 25,
            'image' => 'ork.png'
        ],
        [
            'name' => 'Тролль',
            'health' => 80,
            'max_health' => 80,
            'attack' => 15,
            'defense' => 8,
            'gold_reward' => 40,
            'image' => 'troll.png'
        ]
    ]);
}
}
