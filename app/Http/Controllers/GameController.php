<?php

namespace App\Http\Controllers;

use App\Models\Player; // Используем модель Player
use Illuminate\Http\Request;

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
        // Получаем игрока
        $player = Player::first();
        
        // Создаём монстров (пока без базы)
        $monsters = [
            ['name' => 'Гоблин', 'health' => 30, 'attack' => 8],
            ['name' => 'Орк', 'health' => 50, 'attack' => 12]
        ];
        
        // Выбираем случайного монстра
        $monster = $monsters[array_rand($monsters)];
        
        // Показываем шаблон боя с игроком и монстром
        return view('game.battle', compact('player', 'monster'));
    }

    // Обработка атаки
    public function attack(Request $request)
    {
        // Получаем игрока
        $player = Player::first();
        
        // Генерируем случайный урон
        $damage = rand($player->attack - 3, $player->attack + 5);
        
        // Даём игроку золото за удар
        $player->gold += 10;
        $player->save(); // Сохраняем изменения
        
        // Возвращаемся на страницу боя с сообщением
        return redirect()->route('battle')->with('success', "Вы нанесли $damage урона! +10 золота");
    }
}