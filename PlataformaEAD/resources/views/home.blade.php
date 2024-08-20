@extends('layouts.app')

@section('content')
<div class="container-fluid bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-4">Bem-vindo à Plataforma de Ensino a Distância</h1>
        <p class="lead">Aprenda no seu próprio ritmo, com cursos de alta qualidade ministrados por especialistas.</p>
        <a href="/cadastro" class="btn btn-light btn-lg mt-3">Registre-se Agora</a>
    </div>
</div>

<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Cursos Diversificados</h5>
                    <p class="card-text">Escolha entre uma ampla variedade de cursos em diferentes áreas do conhecimento.</p>
                    <a href="#" class="btn btn-primary">Ver Cursos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Instrutores Experientes</h5>
                    <p class="card-text">Aprenda com profissionais qualificados e obtenha insights valiosos do mercado.</p>
                    <a href="#" class="btn btn-primary">Conheça os Instrutores</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Certificação Reconhecida</h5>
                    <p class="card-text">Ao concluir um curso, receba um certificado reconhecido para alavancar sua carreira.</p>
                    <a href="#" class="btn btn-primary">Saiba Mais</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-light py-5">
    <div class="container text-center">
        <h2 class="mb-4">Por que Escolher Nossa Plataforma?</h2>
        <div class="row">
            <div class="col-md-4">
                <i class="bi bi-laptop fs-1 text-primary"></i>
                <h5 class="mt-3">Acessibilidade</h5>
                <p>Acesse seus cursos a qualquer hora e em qualquer lugar, de qualquer dispositivo.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-people fs-1 text-primary"></i>
                <h5 class="mt-3">Comunidade</h5>
                <p>Faça parte de uma comunidade de alunos e instrutores dedicados.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-book fs-1 text-primary"></i>
                <h5 class="mt-3">Recursos de Qualidade</h5>
                <p>Material didático atualizado e de alta qualidade, preparado por especialistas.</p>
            </div>
        </div>
    </div>
</div>
@endsection
