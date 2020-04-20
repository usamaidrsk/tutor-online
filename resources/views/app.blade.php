<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Inicio' }} | {{ config('app.name') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    {{-- <script src="{{ mix('js/manifest.js') }}" defer></script> --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app"
        data-page-name="{{ $name }}"
        data-route-data="{{ json_encode($data) }}"
        data-csrf-token="{{ csrf_token() }}"
        data-auth="{{ json_encode(['user' => Auth::user() ?? null]) }}"
    ></div>
        window.routes = {!! collect(\Route::getRoutes())->mapWithKeys(function ($route) { return [$route->getName() => $route->uri()]; }) !!}
    </script>
</body>
</html>
