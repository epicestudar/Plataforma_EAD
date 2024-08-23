@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Botão Voltar --}}
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">Voltar</a>
    </div>

    <h1 class="my-4">Criar Curso</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Houve alguns problemas com sua entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" placeholder="Título">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control" placeholder="Descrição"></textarea>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" class="form-control" placeholder="Categoria">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
