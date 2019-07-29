@extends('layouts.app')

<?php $meeting_list_sorted = [];
if (isset($meetings) and is_array($meetings)) {
    foreach($meetings as $meet) {
        $meeting_list_sorted[
            Carbon\Carbon::parse($meet->dateFrom)->weekOfYear . "_" .
            Carbon\Carbon::parse($meet->dateFrom)->year
            ][
            Carbon\Carbon::parse($meet->dateFrom)->year . "_" .
            Carbon\Carbon::parse($meet->dateFrom)->month . "_" .
            Carbon\Carbon::parse($meet->dateFrom)->day
            ][] = $meet;
    }
}
?>

@section('content')
    <main class="ris-content ris-calendar">
        <h1 class="ris-calendar__headline ris-headline">
            Sitzungskalender
        </h1>

        <div class="ris-calendar__flex-wrapper">
            <calendar-app></calendar-app>

            <div class="ris-calendar__content">
                <div class="ris-calendar__card-list-wrapper" data-page-loaded="1" id="card-list">

                    @foreach ($meeting_list_sorted as $meeting_list_per_week)

                        @foreach ($meeting_list_per_week as $meeting_list_per_day)
                            <div class="ris-calendar__card-list">
                                <section class="ris-calendar__card-day">

                                    <div class="ris-calendar__card-day-left"
                                        id="{{ '_' . Carbon\Carbon::parse($meeting_list_per_day[0]->dateFrom)->day
                                        . '_' . Carbon\Carbon::parse($meeting_list_per_day[0]->dateFrom)->month
                                        . '_' . Carbon\Carbon::parse($meeting_list_per_day[0]->dateFrom)->year }}"
                                        >
                                        {{ Carbon\Carbon::parse($meeting_list_per_day[0]->dateFrom)->day }}
                                        <br/>
                                        <span class="ris-calendar__card-day-of-week">
                                            {{ Carbon\Carbon::parse($meeting_list_per_day[0]->dateFrom)->locale('de')->minDayName }}
                                        </span>
                                    </div>

                                    <div class="ris-calendar__card-day-right">
                                        @foreach ($meeting_list_per_day as $meeting)
                                            <div class="ris-calendar__card">
                                                <h2 class="ris-title">
                                                    {{ $meeting->title }}
                                                </h2>
                                                <div class="ris-subheader">
                                                    Lorem data UAK/
                                                    <span>00{{ Carbon\Carbon::parse($meeting->dateFrom)->weekOfYear }}</span>
                                                    /
                                                    <span>{{ Carbon\Carbon::parse($meeting->dateFrom)->year }}</span>
                                                </div>
                                                <div class="ris-session-count">
                                                    <div class="ris-session-count__agenda">{{ $meeting->agendaCount }}</div>
                                                    <div class="ris-session-count__people">{{ $meeting->peopleCount }}</div>
                                                    <div class="ris-session-count__file">{{ $meeting->fileCount }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </section>
                            </div>
                        @endforeach

                        <div class="ris-subheader ris-calendar__card-list-ris-subheader">Kalenderwoche
                            {{ Carbon\Carbon::parse(head($meeting_list_per_week)[0]->dateFrom)->weekOfYear }}
                        </div>

                    @endforeach

                    <calendar></calendar>
                </div>

                @include('layouts.footer')

            </div>

        </div>
    </main>
@endsection
