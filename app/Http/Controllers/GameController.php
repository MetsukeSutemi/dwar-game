<?php

namespace App\Http\Controllers;

use App\Models\Player; // Используем модель Player
use Illuminate\Http\Request;
use App\Models\Monster;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    // Главный экран игры
    public function dashboard()
    {
        // Находим первого игрока в базе
        $player = Player::first();
        
        // Если игрока нет - создаём нового
        if(!$player) {
            $player = Player::create([
                'name' => 'Герой',
                'health' => 100,
                'max_health' => 100,
                'level' => 1,
                'experience' => 0,
                'gold' => 50,
                'attack' => 10,
                'defense' => 5
            ]);
        }
        
        // Показываем шаблон dashboard и передаём игрока
        return view('game.dashboard', compact('player'));
    }

    // Экран боя
    public function battle()
{
    $player = Player::first();
    
    // Получаем или создаем монстра
    $monster = $this->getCurrentMonster();
    
    return view('game.battle', compact('player', 'monster'));
}

public function attack(Request $request)
{
    $player = Player::first();
    $monster = $this->getCurrentMonster();
    
    // Игрок атакует
    $playerDamage = rand($player->attack - 2, $player->attack + 5);
    $actualDamage = $player->attack($monster, $playerDamage);
    
    // Проверяем, побежден ли монстр
    if($monster->health <= 0) {
        // Награда за победу
        $reward = $monster->gold_reward;
        $player->gainGold($reward);
        $player->save();
        
        // Удаляем текущего монстра
        Session::forget('current_monster');
        
        return redirect()->route('battle')
            ->with('success', "Вы победили {$monster->name} и получили {$reward} золота!");
    }

    // Монстр атакует в ответ
    $monsterDamage = rand($monster->attack - 2, $monster->attack + 3);
    $actualMonsterDamage = $monster->attack($player, $monsterDamage);
    $player->save();
    
    // Сохраняем обновленного монстра
    Session::put('current_monster', $monster);
    
    return redirect()->route('battle')
        ->with('success', "Вы нанесли {$actualDamage} урона! {$monster->name} атаковал в ответ и нанес {$actualMonsterDamage} урона.");
}
public function newBattle()
{
    // Удаляем текущего монстра
    Session::forget('current_monster');
    
    return redirect()->route('battle')
        ->with('info', 'Поиск нового противника...');
}
private function getCurrentMonster()
{
    // Если монстр уже в сессии - возвращаем его
    if(Session::has('current_monster')) {
        return Session::get('current_monster');
    }
    
    // Иначе создаем нового
    $monster = Monster::inRandomOrder()->first();
    $monster->health = $monster->max_health; // Полное здоровье
    
    Session::put('current_monster', $monster);
    
    return $monster;
}

}