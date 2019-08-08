@extends('layouts.app')

<?php
    // dd($committees);
?>

@section('content')
    @include('layouts.breadcrumbs')
    <main class="ris-main ris-committee ris-content_six-eight-eight">
        <section class="ris-section-wrapper">
            <h1 class="ris-committee__headline ris-headline">
                Gremien
            </h1>
            <committee-table
                :committees="{{ json_encode($committees) }}"
            ></committee-table>
        </section>
    </main>
    @include('layouts.footer')
@endsection
