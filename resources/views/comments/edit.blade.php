<!-- resources/views/comments/edit.blade.php -->
@extends('comments.app2') <!-- Alterado para usar o layout correto -->

@section('title', 'Editar Comentário') <!-- Definindo um título específico -->

@section('header', 'Editar Comentário') <!-- Definindo o cabeçalho -->

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Comentário</label>
            <textarea name="content" id="content" class="form-control" required>{{ $comment->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Comentário</button>
    </form>

    <a href="{{ route('topics.show', $comment->topic_id) }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection