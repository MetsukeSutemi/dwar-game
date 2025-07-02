<!DOCTYPE html>
<html>
<head>
    <title>Битва | DWAR RPG</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #1a2a3a url('/images/backgrounds/main_background.png') no-repeat center center fixed;
            background-size: cover;
            color: #f0f0f0;
            line-height: 1.6;
        }
        
        .game-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: rgba(10, 20, 30, 0.85);
            min-height: 100vh;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 2px solid #3a6ea5;
        }
        
        h1 {
            font-size: 2.5rem;
            color: #f8c555;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        
        .battle-card {
            background: rgba(30, 40, 50, 0.9);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #4a7ba5;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        
        .combatants {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 40px 0;
        }
        
        .combatant {
            text-align: center;
            width: 40%;
        }
        
        .combatant h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #f8c555;
        }
        
        .vs {
            font-size: 3rem;
            color: #ff5555;
            font-weight: bold;
        }
        
        .health-bar {
            height: 25px;
            background: #444;
            border-radius: 12px;
            margin: 15px 0;
            overflow: hidden;
            border: 1px solid #555;
        }
        
        .health-fill {
            height: 100%;
            background: linear-gradient(90deg, #e52d27, #b31217);
            border-radius: 12px;
        }
        
        .health-info {
            font-size: 1.2rem;
            margin-top: 5px;
        }
        
        .actions {
            text-align: center;
            margin-top: 30px;
        }
        
        .btn {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.3rem;
            border-radius: 50px;
            cursor: pointer;
            margin: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            font-weight: bold;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
        }
        
        .alert {
            padding: 15px;
            background: rgba(46, 125, 50, 0.8);
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .monster-image {
            width: 150px;
            height: 150px;
            background: #333;
            border-radius: 50%;
            margin: 0 auto 20px;
            border: 3px solid #555;
            overflow: hidden;
        }
        
        .monster-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <header>
            <h1>⚔️ БИТВА С МОНСТРОМ ⚔️</h1>
        </header>
        
        <div class="battle-card">
            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="combatants">
                <div class="combatant">
                    <h3>{{ $player->name }}</h3>
                    <div class="monster-image" style="background: #3a6ea5;">
                        <!-- Заглушка для игрока -->
                        <div style="display: flex; justify-content: center; align-items: center; height: 100%; font-size: 4rem;">🛡️</div>
                    </div>
                    
                    <div class="health-bar">
                        <div class="health-fill" 
                            style="width: {{ ($player->health/$player->max_health)*100 }}%">
                        </div>
                    </div>
                    <div class="health-info">
                        {{ $player->health }} / {{ $player->max_health }} HP
                    </div>
                </div>
                
                <div class="vs">VS</div>
                
              <div class="combatant">
    <h3>{{ $monster->name }}</h3>
    <div class="monster-image">
        @if(file_exists(public_path('images/monsters/' . $monster->image)))
            <img src="{{ asset('images/monsters/' . $monster->image) }}" 
                 alt="{{ $monster->name }}">
        @else
            <div style="font-size: 4rem;">👹</div>
        @endif
    </div>
    
    <div class="health-bar">
        <div class="health-fill" 
             style="width: {{ ($monster->health/$monster->max_health)*100 }}%">
        </div>
    </div>
    <div class="health-info">
        {{ $monster->health }} / {{ $monster->max_health }} HP
    </div>
</div>
            </div>
            
            <div class="actions">
                <form action="{{ route('attack') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">АТАКОВАТЬ! ⚔️</button>
                </form>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('dashboard') }}" style="color: #aaa; text-decoration: none;">
                        ← Вернуться в лагерь
                    </a>
                </div>
                <div style="margin-top: 20px;">
    <form action="{{ route('new-battle') }}" method="POST">
        @csrf
        <button type="submit" class="btn" style="background: #6a89cc;">
            Новый противник 🔄
        </button>
    </form>
</div>
            </div>
        </div>
    </div>
</body>
</html>