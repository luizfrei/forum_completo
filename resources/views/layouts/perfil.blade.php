<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de Perfil</title>

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
        .navbar {
            background-color: #343a40;
        }
        .navbar .brand {
            color: white;
            font-size: 20px;
        }
        .navbar .menu a {
            color: white;
            padding: 15px;
        }
        .navbar .menu a:hover {
            background-color: #495057;
        }
        .profile-container {
            margin-top: 80px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            text-align: center; /* Para centralizar o conteúdo */
        }
        .profile-header {
            margin-bottom: 20px;
        }
        .profile-header h1 {
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input {
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: calc(100% - 30px);
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
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .profile-image {
            width: 150px; /* Tamanho da imagem */
            height: 150px; /* Tamanho da imagem */
            border-radius: 50%; /* Para deixar a imagem redonda */
            object-fit: cover; /* Para cobrir o espaço sem distorcer */
            margin-bottom: 20px; /* Espaço abaixo da imagem */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">FalaAí!</a>
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
                        <a class="nav-link" href="{{ route('ListUser', ['uid' => Auth::user()->id]) }}">Perfil</a>
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
    <div class="profile-container">
        <div class="profile-header">
            <h1>Editar Perfil</h1>
        </div>
        @if ($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de Perfil" class="profile-image">
        @else
            <img src="https://via.placeholder.com/150" alt="Foto de Perfil Padrão" class="profile-image">
        @endif
        <form id="registration-form" action="{{ route('UpdateUser', [$user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="profile-fields">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Nome" value="{{ $user->name }}" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="E-mail" value="{{ $user->email }}" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror

                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Senha">
                @error('password') <span class="error">{{ $message }}</span> @enderror

                <label for="photo">Foto de Perfil</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="action-buttons">
                <input type="submit" value="Editar" id="submit-button">
            </div>
        </form>
        <form id="delete-form" action="{{ route('DeleteUser', [$user->id]) }}" method="post" style="margin-top: 20px;">
            @csrf
            @method('delete')
            <input type="submit" value="Deletar" id="delete-button" style="background-color: #dc3545;">
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>