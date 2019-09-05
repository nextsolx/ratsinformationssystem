@foreach ($calendar_list as $calendar)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-card-list__item ris-card-list__item-calendar" title="{{ $calendar->title }}"
        href="{{ route('meeting', $calendar->id) }}"
    >
        <h2 class="ris-h2">
            {{ $calendar->title }}
        </h2>
        <div class="ris-body-2 ris-card-list__calendar-date">
            <span class="ris-i ris-i_calendar-empty"></span>
            {{ \Illuminate\Support\Carbon::parse($calendar->dateFrom)->format('l jS, h:i a') }}
        </div>
        @if ($calendar->location)
            <div class="ris-body-2 ris-card-list__calendar-place">
                <span class="ris-i ris-i_marker-with-dot"></span>
                Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119
            </div>
        @endif
    </a>
@endforeach
