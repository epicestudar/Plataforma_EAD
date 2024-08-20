@extends('layouts.app')




@section('content')
<h1>Dashboard de Cursos</h1>




<form method="GET" action="{{ route('dashboard') }}">
    <input type="search" name="search" placeholder="Pesquisar cursos..." value="{{ request('search') }}">
    <button type="submit">Pesquisar</button>
</form>


<div>
    <a href="/cursos">Acesse dashboard de cursos</a>
</div>




<div class="row">
    @foreach ($cursos as $curso)
    <div class="col-md-4">
        <div class="card">
            <img src="/assets/img/img1.png" class="card-img-top" alt="{{ $curso->titulo }}">
            <div class="card-body">
                <h5 class="card-title">{{ $curso->titulo }}</h5>
                <h5 class="card-title">{{ $curso->categoria }}</h5>
                <p class="card-text">{{ $curso->descricao }}</p>
                <!-- <p class="card-text">Preço: R$ {{ $curso->salario }}</p> -->
                <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-primary">Ver Curso</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection