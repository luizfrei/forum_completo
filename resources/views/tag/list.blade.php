@extends('tag.app')

@section('title', 'Listar Tags')

@section('content')
<div class="container">
    <h2 class="header-title">Lista de Tags</h2>
    @if($tags->isEmpty())
        <div class="alert alert-warning" role="alert">
            Nenhuma tag encontrada.
        </div>
    @else
        @foreach ($tags as $tag)
            <div class="topic">
                <a href="{{ route('showTag', $tag->id) }}">
                    <h3>{{ $tag->title }}</h3>
                </a>
                
                <!-- Exibindo o nome do usuário e a foto de perfil -->
                <p>
                    Criado por: 
                    @if($tag->user)
                        <strong>{{ $tag->user->name }}</strong>
                        @if ($tag->user->photo)
                            <img src="{{ asset('storage/' . $tag->user->photo) }}" alt="Foto de Perfil" class="profile-image">
                        @else
                            <img src="https://via.placeholder.com/40" alt="Foto de Perfil Padrão" class="profile-image">
                        @endif
                    @else
                        <span class="text-muted">Usuário desconhecido</span>
                    @endif
                </p>

                <div class="actions">
                    @if(auth()->user() && auth()->user()->id === $tag->user_id)
                        <a href="{{ route('editTag', $tag->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('DeleteTag', [$tag->id]) }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta tag?');">Deletar</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
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