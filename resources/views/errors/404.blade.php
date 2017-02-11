@extends('welcome')

@section('content')

<section class="content">
  <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Página não encontrada.</h3>
      <p><a href="{{ url('/') }}">Voltar para o Dashboard</a>.</p>
    </div>
  </div>
</section>

@endsection
