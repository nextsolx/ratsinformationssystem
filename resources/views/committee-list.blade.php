@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumbs')
    <main class="ris-main ris-committee-list">
        <committee-table
            :committees="{{ json_encode($committees) }}"
        ></committee-table>
    </main>
    @include('layouts.footer')
@endsection
