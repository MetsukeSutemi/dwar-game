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
    
    // Собираем статистику боя
    $battleStats = [
        'player_damage' => 0,
        'monster_damage' => 0,
        'gold_earned' => 0,
        'exp_earned' => 0 // Пока 0, добавим позже
    ];

    // Игрок атакует
    $playerDamage = rand($player->attack - 2, $player->attack + 5);
    $battleStats['player_damage'] = $player->attack($monster, $playerDamage);
    
    // Проверяем, побежден ли монстр
    $monsterDefeated = $monster->health <= 0;
    
    // Если монстр жив - он атакует в ответ
    if (!$monsterDefeated) {
        $monsterDamage = rand($monster->attack - 2, $monster->attack + 3);
        $battleStats['monster_damage'] = $monster->attack($player, $monsterDamage);
        $playerDefeated = $player->health <= 0;
    }
    
    // Сохраняем состояние
    $player->save();
    Session::put('current_monster', $monster);
    
    // Определяем результат боя
    if ($monsterDefeated) {
        $reward = $monster->gold_reward;
        $player->gold += $reward;
        $player->save();
        
        $battleStats['gold_earned'] = $reward;
        Session::forget('current_monster');
        
        return $this->battleResult('win', $battleStats);
    }
    
    if ($playerDefeated) {
        // Штраф за поражение (можешь настроить как хочешь)
        $penalty = min(20, $player->gold);
        $player->gold -= $penalty;
        $player->save();
        
        Session::forget('current_monster');
        return $this->battleResult('lose', $battleStats);
    }
    
    // Если бой продолжается
    return redirect()->route('battle')->with('success', "Бой продолжается!");
}
public function newBattle()
{
    // Удаляем текущего монстра
    Session::forget('current_monster');
    
    return redirect()->route('battle')
        ->with('info', 'Поиск нового противника...');
}
public function battleResult($result, $battleStats)
{
    return view('game.battle_result', [
        'result' => $result, // 'win' или 'lose'
        'stats' => $battleStats
    ]);
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