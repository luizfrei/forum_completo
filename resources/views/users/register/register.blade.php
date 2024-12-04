<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de Cadastro</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f0f4f8;
        }
        .container {
            margin-top: 80px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        input {
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 20px;
        }
        button, input[type="submit"] {
            background-color: #007bff;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">For1</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Página Inicial</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ListUser ', ['uid' => Auth::user()->id]) }}">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h1>Cadastrar-se</h1>
            <form id="registration-form" action="{{ route('register') }}" method="post">
                @csrf
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Nome" value="{{ old('name')}}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="E-mail" value="{{ old('email')}}" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="password">Senha</label>
                <input type="password" id ="password" name="password" placeholder="Senha" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="password_confirmation">Senha de Confirmação</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Senha de Confirmação" required>

                <input type="submit" value="Cadastrar" id="submit-button">
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>