<script>
import L from 'leaflet';
import { LMap, LTileLayer, LPopup, LPolygon, LMarker } from 'vue2-leaflet';
import MapAside from './MapAside';
require('leaflet-fullscreen');

import location from '../../api/location';
import cityData from '../../api/city.json';
import districtListData from '../../api/districts.json';
import subdistrictListData from '../../api/subdistricts.json';
import postcodeListData from '../../api/postcodes.json';

import districtMarkerListData from '../../api/districtMarkers.json';
import subdistrictMarkerListData from '../../api/subdistrictMarkers.json';
import postcodeMarkerListData from '../../api/postcodeMarkers.json';

export default {
    name: 'MapDesktopApp',
    components: {
        LMap,
        LTileLayer,
        LPopup,
        LPolygon,
        LMarker,
        MapAside,
    },
    data() {
        return {
            zoom: 12,
            zoomSnap: 0.5,
            center: L.latLng(50.9360, 6.9602),
            url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            icon: L.icon({
                iconUrl: './img/map-pin-white.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30],
                className: 'ris-marker'
            }),
            iconActive: L.icon({
                iconUrl: './img/map-pin-red.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30]
            }),
            iconSubdistrict: L.icon({
                iconUrl: './img/map-pin-white.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30],
                className: 'ris-marker__subdistrict'
            }),
            iconSubdistrictActive: L.icon({
                iconUrl: './img/map-pin-red.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30],
                className: 'ris-marker__subdistrict ris-marker__subdistrict_active'
            }),
            iconDistrict: L.icon({
                iconUrl: './img/map-pin-white.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30],
                className: 'ris-marker__district'
            }),
            iconDistrictActive: L.icon({
                iconUrl: './img/map-pin-red.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30],
                className: 'ris-marker__district ris-marker__district_active'
            }),
            primaryColor: '#e1151b',
            secondaryColor: '#8c8c8c',
            thirdColor: '#43fa9d',
            fillColor: '#8c8c8c',
            weightPolygon: 2,
            areaCity: {},
            areaDistrict: {},
            areaSubdistrict: {},
            areaPostcode: {},
            activeDistrict: null,
            hoveredDistrict: null,
            activeSubdistrict: null,
            hoveredSubdistrict: null,
            activePostcode: null,
            hoveredPostcode: null,
            subdistrictPostcodeList: [],
            themePostcodeList: [],
            themeAllDistrictPostcodeList: [],
        };
    },
    computed: {
        districtList() {
            return this.activeDistrict
                ? this.areaDistrict.polygonList.filter(d => d.areaName === this.activeDistrict)
                : this.areaDistrict.polygonList;
        },
        districtMarkerList() {
            return this.activeDistrict
                ? this.areaDistrict.markerList.filter(d => d.areaName === this.activeDistrict)
                : this.areaDistrict.markerList;
        },
        subdistrictList() {
            if (this.activeSubdistrict) {
                return this.areaSubdistrict.polygonList.filter(sub => sub.areaName === this.activeSubdistrict);
            } else if (this.activeDistrict) {
                return this.areaSubdistrict.polygonList.filter(sub => sub.areaParentName === this.activeDistrict);
            } else {
                return this.areaSubdistrict.polygonList;
            }
        },
        subdistrictMarkerList() {
            if (this.activeSubdistrict) {
                return this.areaSubdistrict.markerList.filter(sub => sub.areaName === this.activeSubdistrict);
            } else if (this.activeDistrict) {
                return this.areaSubdistrict.markerList.filter(sub => sub.areaParentName === this.activeDistrict);
            } else {
                return this.areaSubdistrict.markerList;
            }
        },
        postcodeList() {
            if (this.activePostcode) {
                return this.areaPostcode.polygonList.filter(postcode =>
                    +postcode.areaName === +this.activePostcode
                );
            } else if (this.activeSubdistrict) {
                return this.areaPostcode.polygonList.filter(subdistrict =>
                    this.subdistrictPostcodeList.includes(+subdistrict.areaName) && this.themePostcodeList.includes(subdistrict.areaName)
                );
            } else {
                return this.areaPostcode.polygonList;
            }
        },
        postcodeMarkerList() {
            if (this.activePostcode) {
                return this.areaPostcode.markerList.filter(postcode =>
                    +postcode.areaName === +this.activePostcode
                );
            } else if (this.activeSubdistrict) {
                return this.areaPostcode.markerList.filter(subdistrict =>
                    this.themePostcodeList.includes(subdistrict.areaName) && this.subdistrictPostcodeList.includes(+subdistrict.areaName)
                );
            } else if (this.activeDistrict) {
                return this.areaPostcode.markerList.filter(district =>
                    this.themePostcodeList.includes(district.areaName) && this.themeAllDistrictPostcodeList.includes(+district.areaName)
                );
            } else {
                return this.areaPostcode.markerList;
            }
        },
        colorCity() {
            if (this.activeDistrict) {
                return 'transparent';
            } else if (this.hoveredDistrict) {
                return this.secondaryColor;
            } else {
                return this.primaryColor;
            }
        },
        colorDistrict() {
            if (this.activeSubdistrict) {
                return 'transparent';
            } else if (this.hoveredSubdistrict) {
                return this.secondaryColor;
            } else {
                return this.primaryColor;
            }
        },
        colorSubdistrict() {
            if (this.activePostcode) {
                return 'transparent';
            } else if (this.hoveredPostcode) {
                return this.secondaryColor;
            } else {
                return this.primaryColor;
            }
        },
        colorPostcode() {
            if (this.hoveredPostcode && this.activeSubdistrict && this.activePostcode) {
                // different end point logic
                return this.secondaryColor;
            } else if (this.hoveredPostcode) {
                return this.primaryColor;
            } else {
                return this.secondaryColor;
            }
        },
    },
    methods: {
        getCityList() {
            let areaInner = {polygonList: [], markerList: [], latLngBound: []};

            if (cityData) {
                for (let city in cityData.features) {
                    let cityDetail = cityData.features[city];

                    if (cityDetail && cityDetail.attributes && cityDetail.geometry) {
                        // coordinates
                        let geodataReversed = [];
                        cityDetail.geometry.rings[0].map(geodata => {
                            let geodataTmp = geodata.slice().reverse();
                            geodataReversed.push(geodataTmp);
                        });

                        // areaName
                        areaInner.polygonList.push({
                            latLngs: geodataReversed,
                            areaName: cityDetail.attributes.NAME,
                        });

                        // the future zooming to the current lat lng
                        areaInner.latLngBound.push(geodataReversed);
                    }
                }
            }

            return areaInner;
        },
        getDistrictList() {
            let areaInner = {polygonList: [], markerList: [], latLngBound: []};

            if (districtListData) {
                for (let districtList in districtListData.features) {
                    let district = districtListData.features[districtList];

                    if (district && district.attributes && district.geometry) {
                        // coordinates
                        let geodataReversed = [];
                        district.geometry.rings[0].map(geodata => {
                            let geodataTmp = geodata.slice().reverse();
                            geodataReversed.push(geodataTmp);
                        });

                        // areaName
                        areaInner.polygonList.push({
                            latLngs: geodataReversed,
                            areaName: district.attributes.NAME,
                        });

                        // the future zooming to the current lat lng
                        areaInner.latLngBound.push(geodataReversed);
                    }
                }
            }

            if (districtMarkerListData) {
                for (let districtMarkerList in districtMarkerListData.features) {
                    let districtMarker = districtMarkerListData.features[districtMarkerList];

                    if (districtMarker && districtMarker.attributes && districtMarker.geometry) {

                        // coordinates + areaName
                        areaInner.markerList.push({
                            latLngs: districtMarker.geometry.rings,
                            areaName: districtMarker.attributes.NAME,
                        });
                    }
                }
            }

            return areaInner;
        },
        getSubdistrictList() {
            let areaInner = {polygonList: [], markerList: [], latLngBound: []};

            if (subdistrictListData) {
                for (let subdistrictList in subdistrictListData.features) {

                    let subdistrict = subdistrictListData.features[subdistrictList];
                    if (subdistrict && subdistrict.attributes && subdistrict.geometry) {

                        // coordinates
                        let geodataReversed = [];
                        subdistrict.geometry.rings[0].map(geodata => {
                            let geodataTmp = geodata.slice().reverse();
                            geodataReversed.push(geodataTmp);
                        });

                        // areaName
                        areaInner.polygonList.push({
                            latLngs: geodataReversed,
                            areaParentName: subdistrict.attributes.STADTBEZIRK,
                            areaName: subdistrict.attributes.NAME,
                        });

                        // the future zooming to the current lat lng
                        areaInner.latLngBound.push(geodataReversed);
                    }
                }
            }

            if (subdistrictMarkerListData) {
                for (let subdistrictMarkerList in subdistrictMarkerListData.features) {
                    let subdistrictMarker = subdistrictMarkerListData.features[subdistrictMarkerList];

                    if (subdistrictMarker && subdistrictMarker.attributes && subdistrictMarker.geometry) {

                        // coordinates + areaName
                        areaInner.markerList.push({
                            latLngs: subdistrictMarker.geometry.rings,
                            areaParentName: subdistrictMarker.attributes.STADTBEZIRK,
                            areaName: subdistrictMarker.attributes.NAME,
                        });
                    }
                }
            }

            return areaInner;
        },
        getPostcodeList() {
            let areaInner = {polygonList: [], markerList: [], latLngBound: []};

            if (postcodeListData) {
                for (let postcodeList in postcodeListData.features) {

                    let postcode = postcodeListData.features[postcodeList];
                    if (postcode && postcode.attributes && postcode.geometry) {

                        // coordinates
                        let geodataReversed = [];
                        postcode.geometry.rings[0].map(geodata => {
                            let geodataTmp = geodata.slice().reverse();
                            geodataReversed.push(geodataTmp);
                        });

                        // areaName for postcodes by NUMMER !!!
                        // areaParentName not exist for postcodes, because some postcodes exist in several subdistricts/
                        areaInner.polygonList.push({
                            latLngs: geodataReversed,
                            areaName: postcode.attributes.NUMMER,
                        });

                        // the future zooming to the current lat lng
                        areaInner.latLngBound.push(geodataReversed);
                    }
                }
            }

            if (postcodeMarkerListData) {
                for (let postcodeMarkerList in postcodeMarkerListData.features) {
                    let postcodeMarker = postcodeMarkerListData.features[postcodeMarkerList];

                    if (postcodeMarker && postcodeMarker.attributes && postcodeMarker.geometry) {

                        // areaName for postcodes by NUMMER !!!
                        // coordinates + areaName
                        areaInner.markerList.push({
                            latLngs: postcodeMarker.geometry.rings,
                            areaName: postcodeMarker.attributes.NUMMER,
                        });
                    }
                }
            }

            return areaInner;
        },
        getZoomData(areaType, areaName) {
            let areaInner = {polygonList: [], markerList: [], latLngBound: []},
                areaListData;
            areaName = this.areaNameNormalize(areaName);

            if (areaType === 'postcode') {
                areaListData = postcodeListData;
            } else if (areaType === 'district') {
                areaListData = districtListData;
            } else if (areaType === 'subdistrict') {
                areaListData = subdistrictListData;
            } else {
                areaListData = cityData;
            }

            if (areaListData) {
                for (let areaList in areaListData.features) {

                    let area = areaListData.features[areaList],
                        areaAttributesAlias = area.attributes.NAME;
                    if (this.activePostcode) {
                        areaAttributesAlias = area.attributes.NUMMER;
                    }

                    if (area && area.geometry && area.attributes && (areaAttributesAlias === areaName || areaType === 'city')) {
                        // coordinates
                        let geodataReversed = [];
                        area.geometry.rings[0].map(geodata => {
                            let geodataTmp = geodata.slice().reverse();
                            geodataReversed.push(geodataTmp);
                        });

                        // the future zooming to the current lat lng
                        areaInner.latLngBound.push(geodataReversed);
                    }
                }
            }

            return areaInner;
        },
        zoomToSelectedArea(latLngBoundArr) {
            if (latLngBoundArr.length > 0) {
                this.$nextTick(() => {
                    // align and zoom by center of markers
                    let markerBounds = L.latLngBounds(latLngBoundArr);
                    this.$refs.mapDesktopOsm.mapObject.fitBounds(markerBounds);
                });
            }
        },
        openPopup(e) {
            this.$nextTick(() => {
                e.target.openPopup();
            });
        },
        areaNameNormalize(areaName) {
            // district, subdistrict, but except postcode
            if (areaName && typeof areaName !== 'number') {
                areaName = areaName.replace(/-/i, '/');
            }
            return areaName;
        },
        selectDistrict(areaName) {
            if (!this.activeSubdistrict) {
                areaName = this.areaNameNormalize(areaName);
                this.activeDistrict = areaName;

                // zoom to the new location
                const zoomData = this.getZoomData('district', areaName);
                this.zoomToSelectedArea(zoomData.latLngBound);

                // update navigation
                Bus.$emit('district-selected', areaName);
            }
        },
        hoverDistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);
            this.hoveredDistrict = areaName;
        },
        checkDistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);
            return areaName === this.activeDistrict || areaName === this.hoveredDistrict;
        },
        selectSubdistrict(areaName) {
            if (!this.activeSubdistrict) {
                areaName = this.areaNameNormalize(areaName);
                this.activeSubdistrict = areaName;

                // zoom to the new location
                const zoomData = this.getZoomData('subdistrict', areaName);
                this.zoomToSelectedArea(zoomData.latLngBound);

                // update navigation
                Bus.$emit('subdistrict-selected', areaName);

                // get child postcodes
                this.getSubdistrictPostcodeList();
            }
        },
        hoverSubdistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);
            this.hoveredSubdistrict = areaName;
        },
        checkSubdistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);
            return areaName === this.activeSubdistrict || areaName === this.hoveredSubdistrict;
        },
        selectPostcode(areaName) {
            areaName = this.areaNameNormalize(areaName);
            this.activePostcode = areaName;

            // zoom to the new location
            const zoomData = this.getZoomData('postcode', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);

            // update navigation
            Bus.$emit('postcode-selected', areaName);
        },
        hoverPostcode(areaName) {
            areaName = this.areaNameNormalize(areaName);
            this.hoveredPostcode = areaName;
        },
        checkPostcode(areaName) {
            areaName = this.areaNameNormalize(areaName);
            return areaName === this.activePostcode || areaName === this.hoveredPostcode;
        },
        selectByNavigation(areaType, areaName) {
            if (areaType === 'postcode') {
                this.selectPostcode(areaName);
            } else if (areaType === 'district') {
                this.selectDistrict(areaName);
            } else if (areaType === 'subdistrict') {
                this.selectSubdistrict(areaName);
            }
        },
        hoverByNavigation(areaType, areaName) {
            if (areaType === 'postcode') {
                this.hoverPostcode(areaName);
            } else if (areaType === 'district') {
                this.hoverDistrict(areaName);
            } else if (areaType === 'subdistrict') {
                this.hoverSubdistrict(areaName);
            }
        },
        async getSubdistrictPostcodeList() {
            this.subdistrictPostcodeList = await location.getPostcodes(this.activeDistrict, this.activeSubdistrict);
        },
        setThemePostcodeList(postcodeList) {
            this.themePostcodeList = [];
            this.themePostcodeList = postcodeList;
        },
        setThemeAllDistrictPostcodeList(postcodeList) {
            this.themeAllDistrictPostcodeList = [];
            this.themeAllDistrictPostcodeList = postcodeList;
        }
    },
    created() {
        // events for moving from postcode to city
        Bus.$on('select-postcode', areaName => {
            areaName = this.areaNameNormalize(areaName);
            this.activePostcode = areaName;

            // zoom to the new location
            const zoomData = this.getZoomData('postcode', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });

        Bus.$on('select-subdistrict', areaName => {
            areaName = this.areaNameNormalize(areaName);
            this.activeSubdistrict = areaName;
            this.activePostcode = null;

            // zoom to the new location
            const zoomData = this.getZoomData('subdistrict', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });

        Bus.$on('select-district', areaName => {
            areaName = this.areaNameNormalize(areaName);
            this.activeDistrict = areaName;
            this.activeSubdistrict = null;
            this.subdistrictPostcodeList = [];

            // zoom to the new location
            const zoomData = this.getZoomData('district', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });

        Bus.$on('select-city', () => {
            this.activeDistrict = null;
            this.activeSubdistrict = null;
            this.subdistrictPostcodeList = [];
            this.activePostcode = null;

            // zoom to the new location
            const zoomData = this.getZoomData('city');
            this.zoomToSelectedArea(zoomData.latLngBound);
        });
    },
    mounted() {
        this.areaCity = this.getCityList();
        this.areaDistrict = this.getDistrictList();
        this.areaSubdistrict = this.getSubdistrictList();
        this.areaPostcode = this.getPostcodeList();

        this.zoomToSelectedArea(this.areaCity.latLngBound);

        // add the fullscreen button
        this.$nextTick(() => {
            this.$refs.mapDesktopOsm.mapObject.addControl(new L.Control.Fullscreen());
        });
    }
};
</script>

<template>
    <div>
        <MapAside class="ris-map-desktop-aside"
            @mouse-handle="hoverByNavigation($event.type, $event.name)"
            @click-handle="selectByNavigation($event.type, $event.name)"
            @theme-postcode-list="setThemePostcodeList($event)"
            @theme-all-district-postcode-list="setThemeAllDistrictPostcodeList($event)"
                />

        <div id="map-desktop-osm" class="ris-map ris-map__desktop"
            :class="[{ 'ris-map__city_active': !activeDistrict && !activeSubdistrict && !activePostcode },
                     { 'ris-map__district_active': activeDistrict && !activeSubdistrict },
                     { 'ris-map__subdistrict_active': activeSubdistrict && !activePostcode },
                     { 'ris-map__postcode_active': activePostcode }]"
                >
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :zoom-snap="zoomSnap" :center="center"
                    >
                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                        />

                <!--city-->
                <!--<l-polygon
                    v-show="!activeDistrict"
                    v-for="(polygon, index) in areaCity.polygonList"
                    :key="`${index}-${polygon.areaName}-city`"
                    :color="colorCity"
                    :weight="weightPolygon"
                    :fill-color="fillColor"
                    :fill-opacity="activeDistrict ? 0.01 : .2"
                    :lat-lngs="polygon.latLngs"
                        />-->

                <!--district-->
                <l-polygon
                    v-show="!activeSubdistrict"
                    v-for="(polygon, index) in districtList"
                    :key="`${index}-${polygon.areaName}-district`"
                    :color="colorDistrict"
                    :weight="weightPolygon"
                    :fill-color="fillColor"
                    :fill-opacity="!activeSubdistrict && checkDistrict(polygon.areaName) ? .2 : .01"
                    :lat-lngs="polygon.latLngs"
                    :stroke="checkDistrict(polygon.areaName)"

                    @mouseover="hoverDistrict(polygon.areaName)"
                    @mouseleave="hoverDistrict(null)"
                    @click="selectDistrict(polygon.areaName)"
                        />

                <!--subdistrict-->
                <div v-if="activeDistrict && !activePostcode">
                    <l-polygon
                        v-for="(polygon, index) in subdistrictList"
                        :key="`${index}-${polygon.areaName}-subdistrict`"
                        :color="colorSubdistrict"
                        :weight="weightPolygon"
                        :fill-color="fillColor"
                        :fill-opacity="!activePostcode && checkSubdistrict(polygon.areaName) ? .2 : .01"
                        :lat-lngs="polygon.latLngs"
                        :stroke="checkSubdistrict(polygon.areaName)"

                        @mouseover="hoverSubdistrict(polygon.areaName)"
                        @mouseleave="hoverSubdistrict(null)"
                        @click="selectSubdistrict(polygon.areaName)"
                            />
                </div>

                <!--postcode-->
                <div v-if="activeSubdistrict">
                    <l-polygon
                        v-for="(polygon, index) in postcodeList"
                        :key="`${index}-${polygon.areaName}-postcode`"
                        :color="colorPostcode"
                        :weight="weightPolygon"
                        :fill-color="fillColor"
                        :fill-opacity="checkPostcode(polygon.areaName) ? .2 : .01"
                        :lat-lngs="polygon.latLngs"
                        :stroke="checkPostcode(polygon.areaName)"

                        @mouseover="hoverPostcode(polygon.areaName)"
                        @mouseleave="hoverPostcode(null)"
                        @click="selectPostcode(polygon.areaName)"
                            />
                </div>

                <!--district markers-->
                <div v-if="!activeDistrict">
                    <l-marker
                        v-for="(marker, index) in districtMarkerList"
                        :key="`${index}-${marker.areaName}-district-marker`"
                        :lat-lng="marker.latLngs"
                        :icon="checkDistrict(marker.areaName) ? iconDistrictActive : iconDistrict"
                        @add="openPopup"
                            >
                        <l-popup
                            :options="{ autoClose: false }"
                            @mouseover.native="hoverDistrict(marker.areaName)"
                            @mouseleave.native="hoverDistrict(null)"
                            @click.native="selectDistrict(marker.areaName)"
                                >
                            {{ marker.areaName }}
                        </l-popup>
                    </l-marker>
                </div>

                <!--subdistrict markers-->
                <div v-if="activeDistrict && !activeSubdistrict && !activePostcode">
                    <l-marker
                        v-for="(marker, index) in subdistrictMarkerList"
                        :key="`${index}-${marker.areaName}-subdistrict-marker`"
                        :lat-lng="marker.latLngs"
                        :icon="checkSubdistrict(marker.areaName) ? iconSubdistrictActive : iconSubdistrict"
                        @add="openPopup"
                            >
                        <l-popup
                            :options="{ autoClose: false }"
                            @mouseover.native="hoverSubdistrict(marker.areaName)"
                            @mouseleave.native="hoverSubdistrict(null)"
                            @click.native="selectSubdistrict(marker.areaName)"
                                >
                            {{ marker.areaName }}
                        </l-popup>
                    </l-marker>
                </div>

                <!--postcode markers-->
                <div v-if="activeDistrict || activeSubdistrict || activePostcode">
                    <l-marker
                        v-for="(marker, index) in postcodeMarkerList"
                        :key="`${index}-${marker.areaName}-postcode-marker`"
                        :lat-lng="marker.latLngs"
                        :icon="checkPostcode(marker.areaName) ? iconActive : icon"
                        @add="openPopup"
                            >
                        <l-popup
                            v-if="activeSubdistrict"
                            :options="{ autoClose: false }"
                            @mouseover.native="hoverPostcode(marker.areaName)"
                            @mouseleave.native="hoverPostcode(null)"
                            @click.native="selectPostcode(marker.areaName)"
                                >
                            {{ marker.areaName }}
                        </l-popup>
                    </l-marker>
                </div>
            </l-map>
        </div>
    </div>
</template>
