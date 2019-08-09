@foreach ($people_list as $people)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-welcome__people" href="{{ route('people') }}/1"
        title="Constanze Aengenvoort"
    >
        <img src="/img/person-1.jpg" class="ris-welcome__people-img"
            alt="Constanze Aengenvoort"
        />
        <div>
            <div class="ris-body-1">
                Constanze Aengenvoort
            </div>
            <div class="ris-caption">CDU</div>
        </div>
    </a>
@endforeach
