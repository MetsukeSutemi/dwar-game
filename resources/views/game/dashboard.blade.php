<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <style>
        /* Стили для красивого отображения */
    </style>
</head>
<body>
    <div class="game-container">
        <h1>{{ $player->name }}</h1>
        
        <!-- Показываем характеристики игрока -->
        <div class="stats">
            <div>Уровень: {{ $player->level }}</div>
            <div>Здоровье: {{ $player->health }}/{{ $player->max_health }}</div>
            <div>Золото: {{ $player->gold }}</div>
            <div>Атака: {{ $player->attack }}</div>
            <div>Защита: {{ $player->defense }}</div>
        </div>

        <!-- Показываем сообщения (если есть) -->
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Кнопка для перехода к бою -->
        <div class="actions">
            <a href="{{ route('battle') }}">В БОЙ ⚔️</a>
        </div>
    </div>
</body>
</html>