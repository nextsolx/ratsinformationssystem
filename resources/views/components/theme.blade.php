@foreach ($theme_list as $theme)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-card-list__item" title="{{ $theme->name }}"
        href="{{ route('theme', $theme->id) }}"
    >
        <div class="ris-card-list__themes-top">
            <img src="/img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                    alt="{{ $theme->name }}"/>
            <h2 class="ris-h2">
                {{ $theme->name }}
            </h2>
        </div>
        <div class="ris-card-list__themes-bottom">
            <div class="ris-caption ris-card-list__themes-number">
                Thema {{ $theme->reference }}
            </div>

            @if ($theme_type === 'new')
                <div class="ris-progress-bar">
                    <div class="ris-progress-bar__progress" style="width: 25%"></div>
                </div>
            @elseif ($theme_type === 'progress')
                <div class="ris-progress-bar">
                    <div class="ris-progress-bar__progress" style="width: 75%"></div>
                </div>
            @elseif ($theme_type === 'finished')
                <div class="ris-card-list__themes-completed">
                    <span class="ris-i ris-i_check ris-i_has-bg"></span>
                    Abgeschlossen
                </div>
            @endif

            <time class="ris-caption ris-card-list__themes-date">
                {{ \Illuminate\Support\Carbon::parse($theme->date)->format('d.m.Y') }}
            </time>
        </div>
    </a>
@endforeach
