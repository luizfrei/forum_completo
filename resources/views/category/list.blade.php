@extends('category.app')

@section('title', 'Visualizar Categorias')

@section('content')

<div class="container">
    <h2 class="header-title">Lista de Categorias</h2>
    @if($categories->isEmpty())
        <div class="alert alert-warning" role="alert">
            Nenhuma categoria encontrada.
        </div>
    @else
        @foreach ($categories as $category)
            <div class="topic">
                <a href="{{ route('showCategory', $category->id) }}">
                    <h3>{{ $category->title }}</h3>
                    <p>{{ $category->description }}</p>
                    <div class="meta">Criado em: {{ $category->created_at->format('d/m/Y') }}</div>
                </a>
                
                <!-- Exibindo o nome do usuário e a foto de perfil -->
                <p>
                    Criado por: 
                    @if($category->user)
                        <strong>{{ $category->user->name }}</strong>
                        @if ($category->user->photo)
                            <img src="{{ asset('storage/' . $category->user->photo) }}" alt="Foto de Perfil" class="profile-image">
                        @else
                            <img src="https://via.placeholder.com/40" alt="Foto de Perfil Padrão" class="profile-image">
                        @endif
                    @else
                        <span class="text-muted">Usuário desconhecido</span>
                    @endif
                </p>

                <div class="actions">
                    @if(auth()->user() && auth()->user()->id === $category->user_id)
                        <a href="{{ route('editCategory', $category->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('DeleteCategory', [$category->id]) }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta categoria?');">Deletar</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    <a href="{{ route('createCategory') }}" class="btn btn-primary mb-3">Criar Nova Categoria</a>
</div>

<style>
    .container {
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .header-title {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .topic {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        transition: background-color 0.3s;
    }

    .topic:hover {
        background-color: #f7f7f7; /* Cor ao passar o mouse */
    }

    .topic h3 {
        margin: 0;
        color: #007bff;
    }

    .topic p {
        margin: 5px 0;
        color: #555;
    }

    .meta {
        font-size: 0.9em;
        color: #888;
    }

    .actions {
        margin-top: 10px;
    }

    .btn {
        margin-right: 5px;
    }

    .profile-image {
        width: 40px; /* Tamanho da imagem */
        height: 40px; /* Tamanho da imagem */
        border-radius: 50%; /* Torna a imagem redonda */
        margin-left: 5px; /* Espaçamento à esquerda da imagem */
    }
</style>
@endsection