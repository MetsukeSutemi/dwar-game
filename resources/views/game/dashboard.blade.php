<!DOCTYPE html>
<html>
<head>
    <title>Главная | DWAR RPG</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #0d1b2a url('https://i.imgur.com/X6Q7zyA.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #e0e1dd;
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .game-container {
            max-width: 800px;
            width: 100%;
            background: rgba(16, 29, 43, 0.9);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            border: 2px solid #3a5a80;
            position: relative;
            overflow: hidden;
        }
        
        /* Эффект старинного пергамента */
        .game-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://i.imgur.com/5w7QqXf.png') repeat;
            opacity: 0.1;
            pointer-events: none;
        }
        
        .game-header {
            background: linear-gradient(to right, #1b263b, #415a77);
            padding: 25px;
            text-align: center;
            border-bottom: 3px solid #778da9;
            position: relative;
        }
        
        .game-header h1 {
            font-size: 2.8rem;
            color: #f8c555;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
            font-family: 'Times New Roman', serif;
        }
        
        .player-info {
            padding: 30px;
            position: relative;
            z-index: 2;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: rgba(30, 45, 66, 0.7);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            border: 1px solid #4a7ba5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(40, 55, 76, 0.8);
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: #a9d6e5;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .stat-value {
            font-size: 2.2rem;
            font-weight: bold;
            color: #f8c555;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .health-container {
            background: rgba(30, 45, 66, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #4a7ba5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        
        .health-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #a9d6e5;
        }
        
        .health-bar {
            height: 30px;
            background: #444;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #555;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        
        .health-fill {
            height: 100%;
            background: linear-gradient(90deg, #e63946, #d90429);
            border-radius: 15px;
            transition: width 0.5s ease-in-out;
            position: relative;
            overflow: hidden;
        }
        
        /* Анимация пульсации для здоровья */
        .health-fill::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                rgba(255,255,255,0) 0%, 
                rgba(255,255,255,0.2) 50%, 
                rgba(255,255,255,0) 100%);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .alert-container {
            margin-bottom: 30px;
        }
        
        .alert {
            background: rgba(46, 125, 50, 0.8);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 10px;
            border: 1px solid #2e7d32;
            animation: fadeIn 0.5s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .actions {
            text-align: center;
            padding: 0 20px 30px;
        }
        
        .battle-btn {
            display: inline-block;
            background: linear-gradient(135deg, #e63946, #d90429);
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            padding: 18px 50px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Times New Roman', serif;
        }
        
        .battle-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            background: linear-gradient(135deg, #d90429, #e63946);
        }
        
        .battle-btn:active {
            transform: translateY(2px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
        }
        
        .gold-icon {
            width: 25px;
            height: 25px;
        }

        .battle-btn::after {
            content: "⚔️";
            margin-left: 10px;
            display: inline-block;
            animation: swing 1s infinite;
        }
        
        @keyframes swing {
            0%, 100% { transform: rotate(-15deg); }
            50% { transform: rotate(15deg); }
        }
        
        /* Декоративные элементы */
        .corner-decoration {
            position: absolute;
            width: 60px;
            height: 60px;
            background: url('https://i.imgur.com/8XwZR9y.png') no-repeat;
            background-size: contain;
            opacity: 0.7;
        }
        
        .top-left { top: 10px; left: 10px; }
        .top-right { top: 10px; right: 10px; transform: scaleX(-1); }
        .bottom-left { bottom: 10px; left: 10px; transform: scaleY(-1); }
        .bottom-right { bottom: 10px; right: 10px; transform: scale(-1); }
    </style>
</head>
<body>
    <div class="game-container">
        <!-- Декоративные углы -->
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>
        
        <div class="game-header">
            <h1>{{ $player->name }}</h1>
            <p>Славный герой королевства Эльдария</p>
        </div>
        
        <div class="player-info">
            <div class="alert-container">
                @if(session('success'))
                    <div class="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            
            <div class="health-container">
                <div class="health-header">
                    <span>Здоровье</span>
                    <span>{{ $player->health }} / {{ $player->max_health }}</span>
                </div>
                <div class="health-bar">
                    <div class="health-fill" style="width: {{ ($player->health/$player->max_health)*100 }}%"></div>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Уровень</div>
                    <div class="stat-value">{{ $player->level }}</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Золото</div>
                    <div class="stat-value">{{ $player->gold }} <img class="gold-icon" src="{{ asset('images/icons/gold.png') }}" alt="gold"> </div>
                </div>
                
                <div class="stat-card"> 
                    <div class="stat-label">Атака</div>
                    <div class="stat-value">{{ $player->attack }} ⚔️</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Защита</div>
                    <div class="stat-value">{{ $player->defense }} 🛡️</div>
                </div>
            </div>
            
            <div class="actions">
                <a href="{{ route('battle') }}" class="battle-btn">В БОЙ</a>
            </div>
        </div>
    </div>
</body>
</html>