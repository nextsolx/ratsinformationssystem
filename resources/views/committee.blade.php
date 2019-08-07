@extends('layouts.app')

@section('content')
    <main class="ris-content ris-committee">
        <h1 class="ris-committee__headline ris-headline">
            Gremien
        </h1>

        <ul>
        @foreach($committees as $committee)
            <li>{{ $committee['title'] }}</li>
        @endforeach
        </ul>
    </main>
@endsection
