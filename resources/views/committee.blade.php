@extends('layouts.app')
@section('content')
    @include('layouts.breadcrumbs')
    <main class="ris-main ris-committee ris-content_six-eight-eight">
        <section class="ris-section-wrapper">
            <h1 class="ris-committee__headline ris-headline">
                {{ $title }}
            </h1>
            <committee
                :links="{{ json_encode($links) }}"
                :info="{{ json_encode($info) }}"
                :members="{{ json_encode($members) }}"
                :meetings="{{ json_encode($meetings) }}"
            />
        </section>
    </main>
    @include('layouts.footer')
@endsection
