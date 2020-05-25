<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Inicio' }} | {{ config('app.name') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

    @routes
</head>
<body>
    <div id="app"
        data-page-name="{{ $name }}"
        data-layout="{{ $layout }}"
        data-route-data="{{ json_encode($data) }}"
        data-csrf-token="{{ csrf_token() }}"
        data-constants={{ json_encode([
            'APP_NAME' => config('app.name'),
            'APP_CURRENCY_CODE' => config('app.currency_code'),
            'APP_CURRENCY_SYMBOL' => config('app.currency_symbol'),
            'APP_SERVICE_TAX' => config('app.service_tax'),
        ]) }}
        data-auth="{{ json_encode(['user' => Auth::user() ?? null]) }}"
    ></div>
</body>
</html>
