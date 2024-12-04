{{-- resources/views/topics/show.blade.php --}}
@extends('topics.app')

@section('content')
<div class="container">
    <h1>{{ $topic->title }}</h1>
    <p>{{ $topic->description }}</p>
    <p><strong>Status:</strong> {{ $topic->status ? 'Ativo' : 'Inativo' }}</p>
    <p><strong>Criado em:</strong> {{ $topic->created_at }}</p>
    <p><strong>Atualizado em:</strong> {{ $topic->updated_at }}</p>
    <hr>

    <!-- Exibindo Tags -->
    <p>Tags: 
        @if($topic->tags && $topic->tags->isNotEmpty())
            @foreach ($topic->tags as $tag)
                <span class="badge badge-info">{{ $tag->title }}</span>
            @endforeach
        @else
            <span class="text-muted">Nenhuma tag</span>
        @endif
    </p>

    {{-- Exibindo a categoria --}}
    <p><strong>Categoria:</strong> 
        @if($topic->category)
            <span class="badge badge-secondary">{{ $topic->category->title }}</span>
        @else
            <span class="text-muted">Nenhuma categoria</span>
        @endif
    </p>

    {{-- Exibindo a imagem do post associado --}}
    @if ($topic->post && $topic->post->image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $topic->post->image) }}" alt="Imagem do Post" class="img-fluid topic-image">
        </div>
    @else
        <p>Não há imagem para este tópico.</p>
    @endif

    <h2>Comentários</h2>

    @if($topic->comments->isEmpty())
        <p>Não há comentários para este tópico.</p>
    @else
        <ul class="list-group">
            @foreach($topic->comments as $comment)
                <li class="list-group-item">
                    <div class="d-flex align-items-start">
                        @if($comment->user->photo)
                            <img src="{{ asset('storage/' . $comment->user->photo) }}" alt="Foto de {{ $comment->user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        @else
                            <img src="{{ asset('default-profile-picture.png') }}" alt="Foto de {{ $comment->user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px;"> {{-- Imagem padrão se não houver foto --}}
                        @endif
                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->content }}</p>
                            <small>Publicado em: {{ $comment->created_at }}</small>

                            {{-- Exibindo o número de likes e dislikes --}}
                            <div>
                                <span>{{ $comment->likes()->where('is_like', true)->count() }} Likes</span>
                                <span>{{ $comment->likes()->where('is_like', false)->count() }} Dislikes</span>
                            </div>

                            {{-- Agrupando os botões de ação --}}
                            <div class="btn-group float-end" role="group" aria-label="Ações">
                                @if(Auth::check() && Auth::id() === $comment->user_id)
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                    </form>
                                @endif

                                {{-- Formulário para Curtir --}}
                                <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Curtir</button>
                                </form>

                                {{-- Formulário para Descurtir --}}
                                <form action="{{ route('comments.dislike', $comment->id) }}" method="POST" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Descurtir</button>
                                </form>
                            </div>
                        </div>
 </div>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Formulário para adicionar um novo comentário --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::check())
        <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="topic_id" value="{{ $topic->id }}">
            
            <div class="form-group">
                <label for="content">Adicionar Comentário:</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Adicionar Comentário</button>
        </form>
    @else
        <div class="alert alert-warning mt-4">
            Você precisa estar logado para comentar. <a href="{{ route('login') }}">Clique aqui para fazer login</a>.
        </div>
    @endif

    <a href="{{ route('topics.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection

<style>
.topic-image {
    max-width: 100%; 
    height: auto; 
}
</style>