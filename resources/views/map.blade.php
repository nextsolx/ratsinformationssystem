@extends('layouts.app')

@section('content')
    <main class="ris-content ris-map">
        <h1 class="ris-map__headline ris-headline">
            Map
        </h1>

        <map-mobile-app class="map-mobile"></map-mobile-app>

        <map-desktop-app class="map-desktop"></map-desktop-app>


    </main>
@endsection
