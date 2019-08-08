@extends('layouts.app')

@section('content')
    <main class="ris-main ris-people">
        <h1 class="ris-people__headline ris-headline">
            Personen
        </h1>

        {{ dd($title, $info, $members, $meetings) }}

    </main>
@endsection
