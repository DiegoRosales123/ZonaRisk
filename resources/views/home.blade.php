@extends('layouts.app')
@push('stylesheet')
@endpush
@section('content')

<div class="container bg-image"> <!-- Añade la clase bg-image al contenedor -->
  <div class="row justify-content-center">
    <div class="col-md-9">
      <h1 class="mt-3">Hola {{ current_user()->nombre }}, Bienvenido a Zona Risk</h1>
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</div>

@include('_nav')

@endsection

@push('javascript')
<script>
  localStorage.setItem('latitude', -33.51126534675838);
  localStorage.setItem('longitude', -70.75220954411635);
</script>
@endpush
