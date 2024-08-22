@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="/assets/img/img1.png" class="img-fluid" alt="{{ $curso->titulo }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $curso->titulo }}</h2>
                <h2>{{ $curso->categoria }}</h2>
                <p>{{ $curso->descricao }}</p>
                <!-- <p>{{ $curso->localizacao }}</p>
                <p>Preço: R$ {{ $curso->salario }}</p> -->


                <form method="POST" action="{{ route('matricula.add', $curso->id) }}">
                    @csrf
                    
                    <button type="submit" class="btn btn-primary">Fazer Matrícula</button>
                </form>
            </div>
        </div>
    </div>
@endsection