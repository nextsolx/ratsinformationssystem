@foreach ($calendar_list as $calendar)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-card-list__item" title="{{ $calendar->title }}"
        href="/calendar"
    >
        <div class="ris-body-1">
            {{ $calendar->title }}
        </div>
        <div class="ris-caption">BA/0028/2018</div>
        <div class="ris-body-2 ris-card-list__calendar-date">
            <span class="ris-i ris-i_calendar-empty"></span>
            {{ \Illuminate\Support\Carbon::parse($calendar->dateFrom)->format('l jS, h:i a') }}
        </div>
        <div class="ris-body-2 ris-card-list__calendar-place">
            <span class="ris-i ris-i_marker-with-dot"></span>
            Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119
        </div>
    </a>
@endforeach
