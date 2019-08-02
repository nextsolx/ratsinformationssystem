@extends('layouts.app')

@section('content')
    <main class="ris-main ris-themes ris-topic-detail">

        @include('layouts.breadcrumbs')

        <div class="ris-themes__content">

            <h1 class="ris-headline">{{ $topic->name }}</h1>

            <div>{{ $topic->location->description }}</div>

            <div>{{ $topic->location->streetAddress }}</div>

        </div>

        @include('layouts.footer')

    </main>
@endsection
