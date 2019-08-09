@foreach ($people_list as $people)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-welcome__people" href="{{ route('people') }}/1"
        title="{{ $people->name }}"
    >
        <img src="/img/person-1.jpg" class="ris-welcome__people-img"
            alt="{{ $people->name }}"
        />
        <div>
            <div class="ris-body-1">
                {{ $people->name }}
            </div>
            @if ($people->status)
                <div class="ris-caption">{{ $people->status }}</div>
            @endif
        </div>
    </a>
@endforeach
