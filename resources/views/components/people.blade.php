@foreach ($people_list as $person)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-welcome__people" title="{{ $person->name }}"
        href="{{ route('person', $person->id) }}"
        aria-label="{{ $person->name }}"
    >
        <img src="{{ $person->photo ? $person->photo : '/img/thumbnail-avatar-blue.png' }}"
            alt="{{ $person->name }}" class="ris-people__img ris-welcome__people-img"
        />
        <div>
            <div class="ris-body-1">
                {{ $person->name }}
            </div>
            @if ($person->status)
                <div class="ris-caption">{{ $person->status }}</div>
            @endif
        </div>
    </a>
@endforeach
