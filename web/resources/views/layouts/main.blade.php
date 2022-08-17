<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?=asset('css/global.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/landing.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/mapa-de-terras.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/sidebar.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/form.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/listar-terra.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/modal-de-remocao.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/fazer-login.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/listar-dados-por-tabela.css')?>">
    
    <link rel="shortcut icon" href="<?=asset('/images/favicon.png')?>" sizes="200x200" type="image/png" />
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- Usando uma versão hospedada do Leaflet  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body>  
  @yield('content')
</body>
</html>
