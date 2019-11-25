@foreach ($meeting_list as $meeting_list_per_day)
    <div class="ris-calendar__card-list">
        <section class="ris-calendar__card-day">

            <div class="ris-calendar__card-day-left"
                id="{{ '_' . \Illuminate\Support\Carbon::parse($meeting_list_per_day[0]->dateFrom)->day
                    . '_' . \Illuminate\Support\Carbon::parse($meeting_list_per_day[0]->dateFrom)->month
                    . '_' . \Illuminate\Support\Carbon::parse($meeting_list_per_day[0]->dateFrom)->year }}"
            >
                {{ \Illuminate\Support\Carbon::parse($meeting_list_per_day[0]->dateFrom)->day }}
                <br/>
                <span class="ris-calendar__card-day-of-week">
                    {{ \Illuminate\Support\Carbon::parse($meeting_list_per_day[0]->dateFrom)->locale('de')->minDayName }}
                </span>
            </div>

            <div class="ris-calendar__card-day-right">
                @foreach ($meeting_list_per_day as $meeting)
                    <a class="ris-link ris-calendar__card" title="{{ $meeting->title }}"
                        href="/meeting/{{ $meeting->id }}"
                    >
                        <h2 class="ris-title">
                            {{ $meeting->title }}
                        </h2>
                        <div class="ris-subheader">
                            {{ \Illuminate\Support\Carbon::parse($meeting->dateFrom)->isoFormat('LLLL') }}-{{ \Illuminate\Support\Carbon::parse($meeting->dateTill)->format('H:i') }}
                            Uhr
                        </div>
                        <div class="ris-session-count">
                            <div class="ris-session-count__agenda">
                                {{ $meeting->agendaCount }}
                                <span class="ris-i ris-i_list"></span>
                            </div>
                            <div class="ris-session-count__people">
                                {{ $meeting->peopleCount }}
                                <span class="ris-i ris-i_people"></span>
                            </div>
                            <div class="ris-session-count__file">
                                {{ $meeting->fileCount }}
                                <span class="ris-i ris-i_download"></span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </section>
    </div>
@endforeach
