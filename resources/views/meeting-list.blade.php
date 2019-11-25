@extends('layouts.app')

<?php $meeting_list_sorted = [];
if (isset($meetings) and is_array($meetings)) {
    foreach($meetings as $meet) {
        $meeting_list_sorted[
            \Illuminate\Support\Carbon::parse($meet->dateFrom)->weekOfYear . "_" .
            \Illuminate\Support\Carbon::parse($meet->dateFrom)->year
            ][
            \Illuminate\Support\Carbon::parse($meet->dateFrom)->year . "_" .
            \Illuminate\Support\Carbon::parse($meet->dateFrom)->month . "_" .
            \Illuminate\Support\Carbon::parse($meet->dateFrom)->day
            ][] = $meet;
    }
}
?>

@section('content')
    <meeting-list inline-template>

        <main class="ris-main ris-calendar">

            @include('layouts.breadcrumbs')

            <h1 class="ris-h3 ris-calendar__headline">
                Sitzungskalender
                <button @click.prevent="goToToday" class="ris-button ris-button_secondary" title="Heute">
                    <span class="ris-i ris-i_calendar"></span>Heute
                </button>
            </h1>
            <div class="ris-calendar__flex-wrapper ris-content ris-content_has-widget ris-content_six-eight-eight">
                <calendar-plugin></calendar-plugin>
                <div class="ris-calendar__content">
                    <div class="ris-calendar__card-list-wrapper" data-page-loaded="1" id="card-list">

                        @foreach ($meeting_list_sorted as $meeting_list_per_week)
                            <div class="ris-subheader ris-calendar__card-list-ris-subheader">Kalenderwoche
                                {{ \Illuminate\Support\Carbon::parse(head($meeting_list_per_week)[0]->dateFrom)->weekOfYear }}
                            </div>

                            @include('components.meeting.meeting-list',
                                ['meeting_list' => $meeting_list_per_week]
                            )
                        @endforeach

                        <meeting-list-lazy></meeting-list-lazy>
                    </div>
                </div>
            </div>

        </main>

    </meeting-list>

    @include('layouts.footer')

@endsection
