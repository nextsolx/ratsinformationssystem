<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Style guide</title>

        <style>
            body {
                font-family: 'Open Sans', sans-serif;
            }

            .gui-styleguide {
                padding-bottom: 50px;
            }

            .gui-regular-text {
                line-height: 16px;
                padding-bottom: 16px;
            }

            .gui-headline {
                color: #4285F4;
                font-family: Roboto, sans-serif;
                font-size: 20px;
                letter-spacing: 0.2px;
                line-height: 24px;
                box-sizing: border-box;
                border-bottom: 0.5px solid rgba(0,0,0,0.14);
                padding-bottom: 20px;
                margin-bottom: 50px;
                margin-top: 50px;
            }

            .gui-flex-wrapper {
                display: flex;
                flex-wrap: wrap;
            }

            .gui-flex-wrapper_space-between {
                justify-content: space-between;
            }

            .gui-flex-wrapper_column {
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .gui-flex-wrapper_column_space {
                display: flex;
                flex-direction: column;
                flex-grow: 1;
                padding: 30px 50px;
            }

            .gui_light {
                background-color: #EEEEEE;
            }

            .gui_dark {
                background-color: #303030;
            }

            .gui-color-square {
                width: 56px;
                height: 56px;
                margin-bottom: 8px;
                margin-right: 8px;
            }

            .gui-indent-b-r:not(:last-child) {
                margin-bottom: 8px;
                margin-right: 8px;
            }

            .gui-indent-b {
                margin-bottom: 8px;
            }

            .gui-indent-r {
                margin-right: 8px;
            }

            .gui-icons {
                margin-bottom: 16px;
            }

            .gui-icons span {
                margin-right: 15px;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>
    </head>
    <body class="ris-body">
        <section class="ris-main" id="root">
                <div class="gui-styleguide" id="styleguide">
                    <div class="gui-headline">TYPOGRAPHY</div>

                    <div class="gui-flex-wrapper gui-flex-wrapper_space-between">
                        <div class="gui-flex-wrapper_column">
                            <div class="ris-headline"
                                 v-tooltip.left-start="'.ris-headline'"
                                 @click="copy($event)"
                            >Headline</div>
                            <div class="ris-title"
                                 v-tooltip.left-start="'.ris-title'"
                                 @click="copy($event)"
                            >Title</div>
                            <div class="ris-subheader"
                                 v-tooltip.left-start="'.ris-subheader'"
                                 @click="copy($event)"
                            >Subheader</div>
                            <div class="ris-body-2"
                                 v-tooltip.left-start="'.ris-body-2'"
                                 @click="copy($event)"
                            >Body-2-menu</div>
                            <div class="ris-body-1"
                                 v-tooltip.left-start="'.ris-body-1'"
                                 @click="copy($event)"
                            >Body-1</div>
                            <div class="ris-caption"
                                 v-tooltip.left-start="'.ris-caption'"
                                 @click="copy($event)"
                            >Caption</div>
                        </div>

                        <div class="gui-flex-wrapper_column">
                            <div class="ris-headline"
                                 v-tooltip.left-start="'$fs-xxl with .ris-headline'"
                                 data-var-name="$fs-xxl"
                                 @click="copy($event)"
                            >Regular 24px</div>
                            <div class="ris-title"
                                 v-tooltip.left-start="'$fs-xl with .ris-title'"
                                 data-var-name="$fs-xl"
                                 @click="copy($event)"
                            >Medium 20px</div>
                            <div class="ris-subheader"
                                 v-tooltip.left-start="'$fs-l with .ris-subheader'"
                                 data-var-name="$fs-l"
                                 @click="copy($event)"
                            >Regular 16px</div>
                            <div class="ris-body-2"
                                 v-tooltip.left-start="'$fs-m with .ris-body-2'"
                                 data-var-name="$fs-m"
                                 @click="copy($event)"
                            >Medium 14px</div>
                            <div class="ris-body-1"
                                 v-tooltip.left-start="'$fs-m with .ris-body-1'"
                                 data-var-name="$fs-m"
                                 @click="copy($event)"
                            >Regular 14px</div>
                            <div class="ris-caption"
                                 v-tooltip.left-start="'$fs-s with .ris-caption'"
                                 data-var-name="$fs-s"
                                 @click="copy($event)"
                            >Regular 12px</div>
                        </div>

                        <div class="gui-flex-wrapper_column">
                            <div class="gui-flex-wrapper_column_space gui_light">
                                <div class="ris-dark-primary gui-regular-text gui-flex-wrapper gui-flex-wrapper_space-between"
                                     v-tooltip="'$c-dark-primary or .ris-dark-primary'"
                                     data-var-name="$c-dark-primary"
                                     @click="copy($event)"
                                >
                                    <span>Primary</span> <span>#000000</span> <span>87%</span>
                                </div>
                                <div class="ris-dark-secondary gui-regular-text gui-flex-wrapper gui-flex-wrapper_space-between"
                                     v-tooltip="'$c-dark-secondary or .ris-dark-secondary'"
                                     data-var-name="$c-dark-secondary"
                                     @click="copy($event)"
                                >
                                    <span>Secondary</span> <span>#000000</span> <span>54%</span>
                                </div>
                                <div class="ris-dark-disabled gui-regular-text gui-flex-wrapper gui-flex-wrapper_space-between"
                                     v-tooltip="'$c-dark-disabled or .ris-dark-disabled'"
                                     data-var-name="$c-dark-disabled"
                                     @click="copy($event)"
                                >
                                    <span>Disabled</span> <span>#000000</span> <span>38%</span>
                                </div>
                            </div>

                            <div class="gui-flex-wrapper_column_space gui_dark">
                                <div class="ris-light-primary gui-regular-text gui-flex-wrapper gui-flex-wrapper_space-between"
                                     v-tooltip="'$c-light-primary or .ris-light-primary'"
                                     data-var-name="$c-light-primary"
                                     @click="copy($event)"
                                >
                                    <span>Primary</span> <span>#FFFFFF</span> <span>100%</span>
                                </div>
                                <div class="ris-light-secondary gui-regular-text gui-flex-wrapper gui-flex-wrapper_space-between"
                                     v-tooltip="'$c-light-secondary or .ris-light-secondary'"
                                     data-var-name="$c-light-secondary"
                                     @click="copy($event)"
                                >
                                    <span>Secondary</span> <span>#FFFFFF</span> <span>70%</span>
                                </div>
                                <div class="ris-light-disabled gui-regular-text gui-flex-wrapper gui-flex-wrapper_space-between"
                                     v-tooltip="'$c-light-disabled or .ris-light-disabled'"
                                     data-var-name="$c-light-disabled"
                                     @click="copy($event)"
                                >
                                    <span>Disabled</span> <span>#FFFFFF</span> <span>30%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gui-headline">COLOR SYSTEM</div>
                    <div class="gui-flex-wrapper">
                        <div class="gui-color-square ris-bg-black"
                             v-tooltip="'$c-black or .ris-bg-black or .ris-black'"
                             data-var-name="$c-black"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-brown"
                             v-tooltip="'$c-brown or .ris-bg-brown or .ris-brown'"
                             data-var-name="$c-brown"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-red"
                             v-tooltip="'$c-red or .ris-bg-red or .ris-red'"
                             data-var-name="$c-red"
                             @click="copy($event)"
                        ></div>
                    </div>

                    <div class="gui-flex-wrapper">
                        <div class="gui-color-square ris-bg-gray"
                             v-tooltip="'$c-gray or .ris-bg-gray or .ris-gray'"
                             data-var-name="$c-gray"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-gray2"
                             v-tooltip="'$c-gray2 or .ris-bg-gray2 or .ris-gray2'"
                             data-var-name="$c-gray2"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-gray3"
                             v-tooltip="'$c-gray3 or .ris-bg-gray3 or .ris-gray3'"
                             data-var-name="$c-gray3"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-gray4"
                             v-tooltip="'$c-gray4 or .ris-bg-gray4 or .ris-gray4'"
                             data-var-name="$c-gray4"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-gray5"
                             v-tooltip="'$c-gray5 or .ris-bg-gray5 or .ris-gray5'"
                             data-var-name="$c-gray5"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-red2"
                             v-tooltip="'$c-red2 or .ris-bg-red2 or .ris-red2'"
                             data-var-name="$c-red2"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-red3"
                             v-tooltip="'$c-red3 or .ris-bg-red3 or .ris-red3'"
                             data-var-name="$c-red3"
                             @click="copy($event)"
                        ></div>
                    </div>

                    <div class="gui-flex-wrapper">
                        <div class="gui-color-square ris-bg-blue"
                             v-tooltip="'$c-blue or .ris-bg-blue or .ris-blue'"
                             data-var-name="$c-blue"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-blue2"
                             v-tooltip="'$c-blue2 or .ris-bg-blue2 or .ris-blue2'"
                             data-var-name="$c-blue2"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-blue3"
                             v-tooltip="'$c-blue3 or .ris-bg-blue3 or .ris-blue3'"
                             data-var-name="$c-blue3"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-blue4"
                             v-tooltip="'$c-blue4 or .ris-bg-blue4 or .ris-blue4'"
                             data-var-name="$c-blue4"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-blue5"
                             v-tooltip="'$c-blue5 or .ris-bg-blue5 or .ris-blue5'"
                             data-var-name="$c-blue5"
                             @click="copy($event)"
                        ></div>
                    </div>

                    <div class="gui-flex-wrapper">
                        <div class="gui-color-square ris-bg-gray6"
                             v-tooltip="'$c-gray6 or .ris-bg-gray6 or .ris-gray6'"
                             data-var-name="$c-gray6"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-gray7"
                             v-tooltip="'$c-gray7 or .ris-bg-gray7 or .ris-gray7'"
                             data-var-name="$c-gray7"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-gray8"
                             v-tooltip="'$c-gray8 or .ris-bg-gray8 or .ris-gray8'"
                             data-var-name="$c-gray8"
                             @click="copy($event)"
                        ></div>
                        <div class="gui-color-square ris-bg-white2"
                             v-tooltip="'$c-white2 or .ris-bg-white2 or .ris-white2'"
                             data-var-name="$c-white2"
                             @click="copy($event)"
                        ></div>
                    </div>

                    <div class="gui-flex-wrapper">
                        <div class="gui-color-square ris-bg-green"
                             v-tooltip="'$c-green or .ris-bg-green or .ris-green'"
                             data-var-name="$c-green"
                             @click="copy($event)"
                        ></div>

                        <div class="gui-color-square ris-bg-orange"
                             v-tooltip="'$c-orange or .ris-bg-orange or .ris-orange'"
                             data-var-name="$c-orange"
                             @click="copy($event)"
                        ></div>
                    </div>

                    <div class="gui-headline">FORM ITEMS</div>
                    <div class="gui-flex-wrapper">
                        <div>
                            <div>
                                <button class="ris-button ris-button_primary gui-indent-b-r"
                                    v-tooltip="'.ris-button .ris-button_primary'"
                                    @click="copy($event)"
                                >Primary Button</button>
                                <button class="ris-button ris-button_primary ris-button_bg-gray2 gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_primary .ris-button_bg-gray2'"
                                        @click="copy($event)"
                                >Primary Button</button>
                            </div>
                            <div>
                                <button class="ris-button ris-button_secondary ris-button_has-border gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_secondary .ris-button_has-border .ris-gray2'"
                                        @click="copy($event)"
                                >Secondary Button</button>
                                <button class="ris-button ris-button_secondary ris-button_has-shadow gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_secondary .ris-button_has-shadow .ris-gray2'"
                                        @click="copy($event)"
                                >Secondary Button</button>
                                <button class="ris-button ris-button_secondary ris-button_has-border ris-button_bg-gray4 gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_secondary .ris-button_has-border .ris-button_bg-gray4'"
                                        @click="copy($event)"
                                >Secondary Button</button>
                            </div>
                            <div>
                                <button class="ris-button ris-button_secondary gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_secondary'"
                                        @click="copy($event)"
                                >Secondary Button</button>
                                <button class="ris-button ris-button_secondary ris-button_bg-gray4 gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_secondary .ris-button_bg-gray4'"
                                        @click="copy($event)"
                                >Secondary Button</button>
                                <button class="ris-button ris-button_secondary ris-button_red3 gui-indent-b-r"
                                        v-tooltip="'.ris-button .ris-button_secondary .ris-button_red3'"
                                        @click="copy($event)"
                                >Secondary Button</button>
                            </div>
                            <div>
                                <button class="ris-label gui-indent-b"
                                        v-tooltip="'.ris-label'"
                                        @click="copy($event)"
                                >
                                    Tag label
                                    <span class="ris-i ris-i_close"></span>
                                </button>
                            </div>

                            <div class="ris-filter ris-filter_active gui-indent-b"
                                 v-tooltip="'.ris-filter .ris-filter_active'"
                                 @click="copy($event)"
                            >
                                <div class="ris-filter__subheader ris-subheader"
                                     v-tooltip="'.ris-filter__subheader .ris-subheader'"
                                     @click="copy($event)"
                                >
                                    Themen filtern ...
                                    <span class="ris-i ris-i_expand-more"></span>
                                </div>

                                <div class="ris-filter__content">

                                    <button class="ris-label"
                                            v-tooltip="'.ris-label'"
                                            @click="copy($event)"
                                    >
                                        Tag label
                                        <span class="ris-i ris-i_close"></span>
                                    </button>

                                    <a href="#" class="ris-link"
                                       v-tooltip="'.ris-link'"
                                       @click="copy($event)"
                                    >
                                        Primary link
                                    </a>

                                    <br/>

                                    <a href="#" class="ris-link_underline"
                                       v-tooltip="'.ris-link_underline'"
                                       @click="copy($event)"
                                    >
                                        Secondary link
                                    </a>
                                </div>
                            </div>

                            <div class="gui-indent-b">
                                <div class="ris-input-wrapper">
                                    <input class="ris-checkbox" type="checkbox" name="checkThree" id="checkThree" />
                                    <label class="ris-input-label" for="checkThree">Lorem checkbox label</label>
                                </div>
                                <div class="ris-input-wrapper">
                                    <input class="ris-checkbox" type="checkbox" name="checkFour" id="checkFour" checked="checked"/>
                                    <label class="ris-input-label" for="checkFour">Lorem checkbox label Two</label>
                                </div>
                            </div>

                            <div>
                                <div class="ris-input-wrapper">
                                    <input class="ris-radio" type="radio" name="radio" id="radio" />
                                    <label class="ris-input-label" for="radio">Lorem radio label one</label>
                                </div>
                                <div class="ris-input-wrapper">
                                    <input class="ris-radio" type="radio" name="radio" id="radioTwo" checked="checked"/>
                                    <label class="ris-input-label" for="radioTwo">Lorem radio label Two</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gui-headline">ICON SYSTEM</div>

                    <div class="gui-icons gui-indent-b">
                        <span class="ris-i ris-i_apps"></span>
                        <span class="ris-i ris-i_back"></span>
                        <span class="ris-i ris-i_arrow-drop-down"></span>
                        <span class="ris-i ris-i_arrow-drop-up"></span>
                        <span class="ris-i ris-i_arrow-forward"></span>
                        <span class="ris-i ris-i_check"></span>
                        <span class="ris-i ris-i_chevron-left"></span>
                        <span class="ris-i ris-i_chevron-right"></span>
                        <span class="ris-i ris-i_close"></span>
                        <span class="ris-i ris-i_expand-less"></span>
                        <span class="ris-i ris-i_expand-more"></span>
                        <span class="ris-i ris-i_fullscreen"></span>
                        <span class="ris-i ris-i_fullscreen-exit"></span>
                        <span class="ris-i ris-i_menu"></span>
                        <span class="ris-i ris-i_more"></span>
                        <span class="ris-i ris-i_refresh"></span>
                        <span class="ris-i ris-i_add"></span>
                        <span class="ris-i ris-i_favorite"></span>
                        <span class="ris-i ris-i_search"></span>
                        <span class="ris-i ris-i_account-circle"></span>
                        <span class="ris-i ris-i_calendar"></span>
                        <span class="ris-i ris-i_calendar-empty"></span>
                        <span class="ris-i ris-i_calendar-arrow"></span>
                        <span class="ris-i ris-i_download"></span>
                        <span class="ris-i ris-i_list"></span>
                        <span class="ris-i ris-i_people"></span>
                        <span class="ris-i ris-i_info"></span>
                        <span class="ris-i ris-i_star-filled"></span>
                        <span class="ris-i ris-i_marker-with-dot"></span>
                        <span class="ris-i ris-i_filter"></span>
                        <span class="ris-i ris-i_chevron-double"></span>
                        <span class="ris-i ris-i_house"></span>
                        <span class="ris-i ris-i_download-with-box"></span>
                        <span class="ris-i ris-i_eye"></span>
                        <span class="ris-i ris-i_resize-text"></span>
                        <span class="ris-i ris-i_notice-box"></span>
                        <span class="ris-i ris-i_doc"></span>
                        <span class="ris-i ris-i_squares-in-square"></span>

                        <br/><br/>

                        <span class="ris-i ris-i_apps ris-i_has-bg"></span>
                        <span class="ris-i ris-i_back ris-i_has-bg"></span>
                        <span class="ris-i ris-i_arrow-drop-down ris-i_has-bg"></span>
                        <span class="ris-i ris-i_arrow-drop-up ris-i_has-bg"></span>
                        <span class="ris-i ris-i_arrow-forward ris-i_has-bg"></span>
                        <span class="ris-i ris-i_check ris-i_has-bg"></span>
                    </div>

                    <div class="gui-headline">Action Items</div>

                    <div class="ris-action-box">
                        <div class="ris-filter"
                             :class="{'ris-filter_active': activeFilter}"
                        >
                            <div class="ris-filter__subheader ris-subheader"
                                 @click="collapseFilter"
                            >
                                <span class="ris-i ris-i_filter"></span>
                                Filtern
                            </div>

                            <div class="ris-filter__content-wrapper">
                                <div class="ris-filter__content">

                                    <div class="ris-filter-buttons">
                                        <div class="ris-filter-buttons__title">
                                            Nach Bezirken filtern
                                        </div>

                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Innenstadt
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Rodenkirchen
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Lindenthal
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Ehrenfeld
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Nippes
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Chorweiler
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Porz
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Kalk
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Mülheim
                                        </button>
                                    </div>

                                    <div class="ris-filter-buttons">
                                        <div class="ris-filter-buttons__title">
                                            Nach Postleitzahlen filtern
                                        </div>

                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Innenstadt
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Rodenkirchen
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Lindenthal
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Ehrenfeld
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Nippes
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Chorweiler
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Porz
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Kalk
                                        </button>
                                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                                            Mülheim
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="ris-select">
                            <div class="ris-select__label">Sortierung</div>
                            <select class="ris-select__select">
                                <option class="ris-select__option" data-sort-type="progress">
                                    Fortschritt
                                </option>
                                <option class="ris-select__option" data-sort-type="creation-date">
                                    Einstellungsdatum
                                </option>
                            </select>
                            <span class="ris-i ris-i_chevron-double"></span>
                        </div>

                    </div>

                    <div class="ris-filter ris-filter_has-indent gui-indent-b">
                        <div class="ris-filter__title ris-title"
                             v-tooltip="'.ris-filter__title .ris-title'"
                        >Neueste Kategorien</div>

                        <div class="gui-flex-wrapper gui-indent-b">
                            <div class="ris-select gui-indent-r">
                                <div class="ris-select__label">Sortierung long label, see mobile</div>
                                <select class="ris-select__select">
                                    <option class="ris-select__option" value="progress" data-sort-type="progress">
                                        Fortschritt long option, see mobile
                                    </option>
                                    <option class="ris-select__option" value="creation-date" data-sort-type="creation-date">
                                        Einstellungsdatum
                                    </option>
                                </select>
                                <span class="ris-i ris-i_chevron-double"></span>
                            </div>
                            <div class="ris-select">
                                <select class="ris-select__select ris-gray2"
                                        v-tooltip="'.ris-select__select .ris-gray2'"
                                        name="menu2" id="ris-menu2"
                                >
                                    <option value="11-jan">11.Jan</option>
                                    <option value="25-jan">25.Jan</option>
                                    <option value="30-jan">30.Jan</option>
                                </select>
                                <span class="ris-i ris-i_chevron-double"></span>
                            </div>
                        </div>

                        <button class="ris-button ris-button_primary ris-button_bg-gray2 ris-button_full gui-indent-b"
                                v-tooltip="'.ris-button .ris-button_primary .ris-button_bg-gray2 .ris-button_full'"
                                @click="copy($event)"
                        >Primary Button</button>
                        <button class="ris-button ris-button_secondary ris-button_blue2 ris-button_full"
                                v-tooltip="'.ris-button .ris-button_secondary .ris-button_blue2 .ris-button_full'"
                                @click="copy($event)"
                        >Secondary Button</button>
                    </div>

                    <div class="gui-indent-b">
                        <div class="ris-search">
                            <button class="ris-search__button"></button>
                            <input type="search" class="ris-search__input"
                                   placeholder="Suche nach Themen, Vorlagen, Sitzungen..."
                            />
                        </div>
                    </div>
                </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
        <script src="https://unpkg.com/v-tooltip"></script>
        <script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>

        <script type="text/javascript">
            Vue.directive('tooltip', VTooltip.VTooltip);

            new Vue({
                el: '#styleguide',
                methods: {
                    copy(item) {
                        const itemCopyClass = `.${item.target.classList[0]}`;


                        // copy class
                        let typeOfdata = 'class';
                        const clipboard = new ClipboardJS(itemCopyClass, {
                            text: function(target) {
                                const itemVarName = target.getAttribute('data-var-name');
                                if (itemVarName) {
                                    typeOfdata = 'var name';
                                    return itemVarName;
                                } else {
                                    return itemCopyClass;
                                }
                            }
                        });

                        // show info tooltip
                        clipboard.on('success', function(e) {
                            const tooltip = new VTooltip.createTooltip(e.trigger, `Copied ${typeOfdata}!`);
                            tooltip.show();
                            e.clearSelection();
                        });
                    }
                },
            });
        </script>
    </body>
</html>
