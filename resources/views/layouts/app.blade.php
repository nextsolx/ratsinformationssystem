<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Die Startseite von SessionNet-B&uuml;rgerinfo liefert aktuelle Informationen f&uuml;r die &Ouml;ffentlichkeit. So kann z.B. auf einen Blick erfasst werden, wann Sitzungen stattfinden.">

        <title>Informationssystem f&uuml;r B&uuml;rgerinnen und B&uuml;rger</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>
    </head>
    <body class="ris-body">

        <div id="root"
             class="ris-wrapper"
            :class="{ 'ris-nav__root_active': navActive }"
             v-cloak
        >
            @include('layouts.header')

            @yield('content')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
