@extends('layouts.app')
{{ dd($members)  }}
@section('content')
    <main class="ris-main ris-people">
        <h1 class="ris-people__headline ris-headline">
            Personen List
        </h1>

        <a href="/personen/">Go to temporary person page</a>
    </main>
@endsection
