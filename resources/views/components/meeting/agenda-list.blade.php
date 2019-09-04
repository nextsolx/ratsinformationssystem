@foreach ($agenda_grouped_list as $agenda_list)
    @foreach ($agenda_list as $agenda)
        @if (count($agenda_list) === 1)
            @if ($agenda->public === $agenda_public_type)
                <div class="ris-agenda-list__item ris-agenda-list__agenda-without-child"
                    ref="{{ $agenda->id }}"
                    v-if="(!inputValueAgenda || inputValueAgenda.length === 1) || agendaListSorted['{{ $agenda->id }}']"
                >
                    <div class="ris-description ris-description__count">
                        {{ $agenda->number }}
                    </div>
                    <div class="ris-description ris-description__headline">
                        {{ strip_tags($agenda->name) }}
                    </div>
                    <div class="ris-description ris-description__content">
                        <span class="ris-text">0</span>
                    </div>
                </div>
            @endif
        @else
            @if ($agenda->public === $agenda_public_type)
                @if (strpos($agenda->number, "."))
                    <div class="ris-agenda-list__item ris-agenda-list__agenda-child
                        _agenda-child-{{ $agenda_public_type }}-{{ (int)$agenda->number }}"
                        ref="{{ $agenda->id }}"
                        v-if="agendaListSorted['{{ $agenda->id }}'] || agendaChildRef['{{ $agenda->id }}'] || isActiveChild"
                    >
                        <div class="ris-description ris-description__count ris-description_normal">
                            {{ $agenda->number }}
                        </div>
                        <div class="ris-description ris-description__headline ris-description_normal">
                            @if (isset($agenda->resolutionText))
                                {{ strip_tags($agenda->resolutionText) }}
                            @else
                                {{ strip_tags($agenda->name) }}
                            @endif

                            {{--@todo - fix mock data--}}
                            <div class="ris-caption">In Bearbeitung</div>
                        </div>
                    </div>
                @else
                    <div class="ris-agenda-list__item ris-agenda-list__agenda-head
                        _agenda-head-{{ $agenda_public_type }}-{{ (int)$agenda->number }}"
                        :class="{'ris-agenda-list__agenda-head_active': agendaParentRef['{{ $agenda->id }}']}"
                        @click="collapseAgendaChild({{ (int)$agenda->number }}, {{ $agenda_public_type }}, '{{ $agenda->id }}')"
                        ref="{{ $agenda->id }}"
                        v-if="(!inputValueAgenda || inputValueAgenda.length === 1) || agendaListSorted['{{ $agenda->id }}']"
                    >
                        <div class="ris-description ris-description__count">
                            {{ $agenda->number }}
                        </div>
                        <div class="ris-description ris-description__headline">
                            {{ strip_tags($agenda->name) }}
                        </div>
                        <div class="ris-description ris-description__content">
                            <span class="ris-text ris-text__count">{{ count($agenda_list) - 1 }}</span>
                            <span class="ris-i ris-i_expand-more"></span>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    @endforeach
@endforeach
