<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('adminlte.title', 'News Portal') }}</title>
    @adminlte_css
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('adminlte::page')
    @yield('content')
</div>
@adminlte_js
@yield('js')
</body>
</html>