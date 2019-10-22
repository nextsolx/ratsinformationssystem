@extends('layouts.app')

@section('content')
    <main class="ris-main ris-people">

        @include('layouts.breadcrumbs')

        <people-table></people-table>
    </main>
    @include('layouts.footer')
@endsection
