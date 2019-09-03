@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumbs')
    <main class="ris-main ris-people">
        <people-table></people-table>
    </main>
    @include('layouts.footer')
@endsection
