@foreach ($theme_list as $theme)
    @if (isset($limit))
        @if ($loop->iteration > $limit)
            @break
        @endif
    @endif

    <a class="ris-card-list__item" title="{{ $theme->name }}"
            href="/thema/{{ $theme->id }}"
    >
        <div class="ris-card-list__themes-top">
            <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                    alt="{{ $theme->name }}"/>
            <div class="ris-body-1">
                {{ $theme->name }}
            </div>
        </div>
        <div class="ris-card-list__themes-bottom">
            <div class="ris-caption ris-card-list__themes-number">
                Thema &nbsp;
                <span>2477</span>
                /
                <span>{{ Carbon\Carbon::parse('27.10.2018')->year }}</span>
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
                    <span class="ris-i ris-i__check ris-i_has-bg"></span>
                    Abgeschlossen
                </div>
            @endif

            <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
        </div>
    </a>
@endforeach