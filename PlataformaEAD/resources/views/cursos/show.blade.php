@extends('layouts.app')

@section('content')
<div class="container mt-5">
    {{-- Botão Voltar --}}
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">Voltar</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="/assets/img/img1.png" class="card-img-top img-fluid" alt="{{ $curso->titulo }}">
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="display-4">{{ $curso->titulo }}</h1>
            <h5 class="text-muted">{{ $curso->categoria }}</h5>
            <hr>
            <h3>Sobre o Curso</h3>
            <p>{{ $curso->descricao }}</p>

            <div class="mt-4">
                <h4>Detalhes do Curso</h4>
                <ul>
                    <li>Duração: 40 horas</li>
                    <li>Nível: Intermediário</li>
                    <li>Professor: {{ $curso->professor->nome }}</li> <!-- Nome do professor -->
                    <li>Cidade: {{ $curso->professor->cidade }}</li> <!-- Cidade do professor -->
                    <li>E-mail: {{ $curso->professor->email }}</li> <!-- E-mail do professor -->
                </ul>
            </div>

            @if (!$jaMatriculado)
                <form method="POST" action="{{ route('matricula.add', $curso->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Fazer Matrícula</button>
                </form>
            @else
                <p class="text-success">Você já está matriculado neste curso.</p>
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <h4>Avaliações dos Alunos</h4>
            <!-- Exemplo de avaliação -->
            <div class="card shadow-sm my-3">
                <div class="card-body">
                    <h5>Maria Silva</h5>
                    <p>"Excelente curso, muito bem explicado e com material de apoio de qualidade."</p>
                </div>
            </div>
            <!-- Adicionar mais avaliações conforme necessário -->
        </div>
    </div>
</div>
@endsection
