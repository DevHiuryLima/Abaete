<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}">

  @if(Route::currentRouteName() == 'home')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}">
  @endif

  @if(Route::currentRouteName() == 'login')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fazer-login.css') }}">
  @endif
  
  @if(Route::currentRouteName() == 'terras')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mapa-de-terras.css') }}">
  @endif

  @if(Route::currentRouteName() == 'listar.terra')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/listar-terra.css') }}">
  @endif
  

  <!-- Quando um estilo css pertence a mais de uma tela. -->
  @if(Route::currentRouteName() == 'redireciona.criar.terra' || Route::currentRouteName() == 'redireciona.editar.terra' || Route::currentRouteName() == 'redireciona.criar.quiz' || Route::currentRouteName() == 'redireciona.editar.quiz' || Route::currentRouteName() == 'redireciona.criar.administrador' || Route::currentRouteName() == 'redireciona.editar.administrador')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
  @endif
  
  @if(Route::currentRouteName() == 'listar.terra' || Route::currentRouteName() == 'redireciona.criar.terra' || Route::currentRouteName() == 'redireciona.editar.terra' || Route::currentRouteName() == 'redireciona.criar.quiz' || Route::currentRouteName() == 'redireciona.editar.quiz' || Route::currentRouteName() == 'redireciona.criar.administrador' || Route::currentRouteName() == 'redireciona.editar.administrador')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar-pequeno.css') }}">
  @endif

  @if(Route::currentRouteName() == 'administradores' || Route::currentRouteName() == 'quizzes')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/listar-dados-por-tabela.css') }}">
  @endif

  @if(Route::currentRouteName() == 'terras' || Route::currentRouteName() == 'administradores' || Route::currentRouteName() == 'quizzes')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar-grande.css') }}">
  @endif

  @if(Route::currentRouteName() == 'listar.terra' || Route::currentRouteName() == 'redireciona.editar.terra' || Route::currentRouteName() == 'administradores' || Route::currentRouteName() == 'quizzes')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal-de-remocao.css') }}">
  @endif


    
  <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}" sizes="200x200" type="image/png" />
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  <!-- Usando uma versão hospedada do Leaflet  -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body>  
  @yield('content')

<script>
  const APP_URL = `{{env('APP_URL')}}`;
  const API_URL = `{{env('APP_URL')}}` + `/api`;
</script>
@stack('scripts')
</body>
</html>