<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Tailwind CSS styles */
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #4B0082;  /* Dark purple */
        }
        .splash-screen {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            height: 100%;
            background-color: #4B0082;  /* Dark purple */
            animation: fadeIn 1s ease-in-out;
        }
        .splash-screen img {
            width: 200px;
            height: 200px;
            margin-bottom: 1rem;
        }
        .greeting-card {
          
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            animation: slideIn 1s ease-in-out;
        }
        .greeting-card h1 {
            margin: 0;
            font-size: 2rem;
            color: white;
        }
        .links {
            margin-top: 1rem;
        }
        .links a {
            margin: 0 0.5rem;
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        .links a:hover {
            color:rgb(247, 9, 171);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="splash-screen">
        <div class="greeting-card">
            <h1>Welcome!</h1>
        </div>
        <img src="{{ asset('images/gloweralogo.png') }}" alt="Website Logo">
        <div class="links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>