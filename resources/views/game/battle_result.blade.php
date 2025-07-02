<!DOCTYPE html>
<html>
<head>
    <title>Результат боя</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #0d1b2a url('https://i.imgur.com/5w7QqXf.png') repeat;
            color: #e0e1dd;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .result-container {
            max-width: 800px;
            width: 100%;
            background: rgba(16, 29, 43, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.8);
            border: 3px solid #3a5a80;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .result-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://i.imgur.com/8XwZR9y.png') center no-repeat;
            opacity: 0.1;
            pointer-events: none;
        }
        
        .result-header {
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }
        
        .result-title {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(255,255,255,0.5);
            font-family: 'Times New Roman', serif;
        }
        
        .victory {
            color: #f8c555;
            animation: glow 2s infinite alternate;
        }
        
        .defeat {
            color: #e63946;
            animation: pulse 2s infinite;
        }
        
        @keyframes glow {
            from { text-shadow: 0 0 5px #f8c555; }
            to { text-shadow: 0 0 20px #ffd700, 0 0 30px #ffd700; }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .result-icon {
            font-size: 6rem;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        .stats-table {
            width: 100%;
            max-width: 600px;
            margin: 0 auto 30px;
            border-collapse: collapse;
            background: rgba(30, 45, 66, 0.7);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .stats-table th {
            background: #1b3b5e;
            padding: 15px;
            font-size: 1.3rem;
            color: #f8c555;
        }
        
        .stats-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #2a4a6e;
        }
        
        .stats-table tr:last-child td {
            border-bottom: none;
        }
        
        .stats-table .label {
            text-align: right;
            font-weight: bold;
            color: #a9d6e5;
        }
        
        .stats-table .value {
            text-align: left;
            color: #f8c555;
            font-size: 1.2rem;
        }
        
        .continue-btn {
            display: inline-block;
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
            color: white;
            font-size: 1.5rem;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            z-index: 2;
            margin-top: 20px;
            font-weight: bold;
        }
        
        .continue-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5);
        }
        
        .continue-btn:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <div class="result-container">
        <div class="result-header">
            @if($result === 'win')
                <div class="result-title victory">ПОБЕДА!</div>
                <div class="result-icon">🏆</div>
            @else
                <div class="result-title defeat">ПОРАЖЕНИЕ</div>
                <div class="result-icon">💀</div>
            @endif
        </div>
        
        <table class="stats-table">
            <thead>
                <tr>
                    <th colspan="2">Статистика боя</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label">Нанесено урона:</td>
                    <td class="value">{{ $stats['player_damage'] }}</td>
                </tr>
                <tr>
                    <td class="label">Получено урона:</td>
                    <td class="value">{{ $stats['monster_damage'] }}</td>
                </tr>
                <tr>
                    <td class="label">Заработано золота:</td>
                    <td class="value">{{ $stats['gold_earned'] }}</td>
                </tr>
                @if($stats['exp_earned'] > 0)
                <tr>
                    <td class="label">Получено опыта:</td>
                    <td class="value">{{ $stats['exp_earned'] }}</td>
                </tr>
                @endif
            </tbody>
        </table>
        
        <a href="{{ route('dashboard') }}" class="continue-btn">
            Продолжить
        </a>
    </div>
</body>
</html>