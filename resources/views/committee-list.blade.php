@extends('layouts.app')

@section('content')
    <main class="ris-main ris-committee-list">

        @include('layouts.breadcrumbs')

        <committee-table
            :committees="{{ json_encode($committees) }}"
        ></committee-table>
    </main>
    @include('layouts.footer')
@endsection
