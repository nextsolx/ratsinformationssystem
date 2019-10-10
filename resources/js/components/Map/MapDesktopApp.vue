<script>
import L from 'leaflet';
import { LMap, LTileLayer, LPopup, LPolygon, LMarker } from 'vue2-leaflet';
import MapAside from './MapAside';
require('leaflet-fullscreen');

import cityData from '../../api/city.json';
import districtListData from '../../api/districts.json';
import subdistrictListData from '../../api/subdistricts.json';
import postcodeListData from '../../api/postcode.json';

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
                iconUrl: './img/map_pin.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30]
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
        };
    },
    computed: {
        districtList() {
            return this.activeDistrict
                ? this.areaDistrict.polygonList.filter(d => d.areaName === this.activeDistrict)
                : this.areaDistrict.polygonList;
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
        postcodeList() {
            if (this.activePostcode) {
                return this.areaPostcode.polygonList.filter(sub => sub.areaName === this.activePostcode);
            } else if (this.activeSubdistrict) {
                return this.areaPostcode.polygonList.filter(sub => sub.areaParentName === this.activeSubdistrict);
            } else {
                return this.areaPostcode.polygonList;
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
        }
    },
    methods: {
        getCityPolygonList() {
            let areaInner = {polygonList: [], pointList: [], latLngBound: []};

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
        getDistrictPolygonList() {
            let areaInner = {polygonList: [], pointList: [], latLngBound: []};

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

            return areaInner;
        },
        getSubdistrictPolygonList() {
            let areaInner = {polygonList: [], pointList: [], latLngBound: []};

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

            return areaInner;
        },
        getPostcodePolygonList() {
            let areaInner = {polygonList: [], pointList: [], latLngBound: []};

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

                        // areaName
                        areaInner.polygonList.push({
                            latLngs: geodataReversed,
                            areaParentName: postcode.attributes.STADTBEZIRK,
                            areaName: postcode.attributes.NAME,
                        });

                        // the future zooming to the current lat lng
                        areaInner.latLngBound.push(geodataReversed);
                    }
                }
            }

            return areaInner;
        },
        getZoomData(areaType, areaName) {
            let areaInner = {polygonList: [], pointList: [], latLngBound: []},
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

                    let area = areaListData.features[areaList];
                    if (area && area.geometry && area.attributes && (area.attributes.NAME === areaName || areaType === 'city')) {
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
            areaName = this.areaNameNormalize(areaName);
            this.activeDistrict = areaName;

            // zoom to the new location
            const zoomData = this.getZoomData('district', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);

            // update navigation
            Bus.$emit('district-selected', areaName);
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
            areaName = this.areaNameNormalize(areaName);
            this.activeSubdistrict = areaName;

            // zoom to the new location
            const zoomData = this.getZoomData('subdistrict', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);

            // update navigation
            Bus.$emit('subdistrict-selected', areaName);
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
    },
    created() {
        Bus.$on('select-postcode', areaName => {
            areaName = this.areaNameNormalize(areaName);
            this.activePostcode = areaName;
            this.activeDistrict = null;
            this.activeSubdistrict = null;

            // zoom to the new location
            const zoomData = this.getZoomData('postcode', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });

        Bus.$on('select-district', areaName => {
            areaName = this.areaNameNormalize(areaName);
            this.activeDistrict = areaName;
            this.activeSubdistrict = null;

            // zoom to the new location
            const zoomData = this.getZoomData('district', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });

        Bus.$on('select-city', () => {
            this.activePostcode = null;
            this.activeDistrict = null;
            this.activeSubdistrict = null;

            // zoom to the new location
            const zoomData = this.getZoomData('city');
            this.zoomToSelectedArea(zoomData.latLngBound);
        });
    },
    mounted() {
        this.areaCity = this.getCityPolygonList();
        this.areaDistrict = this.getDistrictPolygonList();
        this.areaSubdistrict = this.getSubdistrictPolygonList();
        this.areaPostcode = this.getPostcodePolygonList();

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
                />

        <div id="map-desktop-osm" class="ris-map ris-map__desktop"
                >
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :zoom-snap="zoomSnap" :center="center"
                    >
                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                        />

                <!--city-->
                <l-polygon
                    v-show="!activeDistrict"
                    :color="colorCity"
                    :fill-color="fillColor"
                    :fill-opacity="activeDistrict ? 0.01 : .2"
                    :weight="weightPolygon"
                    v-for="(polygon, index) in areaCity.polygonList"
                    :key="`${index}-${polygon.areaName}-city`"
                    :lat-lngs="polygon.latLngs"
                        />

                <!--district-->
                <l-polygon
                    :color="colorDistrict"

                    :fill-color="fillColor"
                    :weight="weightPolygon"
                    v-for="(polygon, index) in districtList"
                    :key="`${index}-${polygon.areaName}-district`"
                    :lat-lngs="polygon.latLngs"

                    :fill-opacity="!activeSubdistrict && checkDistrict(polygon.areaName) ? .2 : .01"
                    :stroke="checkDistrict(polygon.areaName)"

                    @mouseover="hoverDistrict(polygon.areaName)"
                    @mouseleave="hoverDistrict(null)"

                    @click="selectDistrict(polygon.areaName)"
                        />

                <!--subdistrict-->
                <div v-if="activeDistrict">
                    <l-polygon
                        :color="checkSubdistrict(polygon.areaName) ? primaryColor : secondaryColor"

                        :fill-color="fillColor"
                        :weight="weightPolygon"
                        v-for="(polygon, index) in subdistrictList"
                        :key="`${index}-${polygon.areaName}-subdistrict`"
                        :lat-lngs="polygon.latLngs"

                        :fill-opacity="checkSubdistrict(polygon.areaName) ? .2 : .01"
                        :stroke="checkSubdistrict(polygon.areaName)"

                        @mouseover="hoverSubdistrict(polygon.areaName)"
                        @mouseleave="hoverSubdistrict(null)"

                        @click="selectSubdistrict(polygon.areaName)"
                            />
                </div>

                <!--postcode-->
                <div v-if="activeSubdistrict">
                    <l-polygon
                        :color="checkPostcode(polygon.areaName) ? primaryColor : secondaryColor"

                        :fill-color="fillColor"
                        :weight="weightPolygon"
                        v-for="(polygon, index) in postcodeList"
                        :key="`${index}-${polygon.areaName}-postcode`"
                        :lat-lngs="polygon.latLngs"

                        :fill-opacity="checkPostcode(polygon.areaName) ? .2 : .01"
                        :stroke="checkPostcode(polygon.areaName)"

                        @mouseover="hoverPostcode(polygon.areaName)"
                        @mouseleave="hoverPostcode(null)"

                        @click="selectPostcode(polygon.areaName)"
                            />
                </div>


                <!--<l-marker
                    v-for="(marker, index) in area.pointList"
                    :key="index"
                    :lat-lng="marker.latLng"
                    :icon="icon"
                    @add="openPopup"
                        >
                    <l-popup
                        :options="{ autoClose: false }"
                        @click.native="selectArea(marker.areaType, marker.areaName, true)"
                        @mouseover.native="showArea(marker.areaType, marker.areaName, true)"
                        @mouseleave.native="showArea(marker.areaType, marker.areaName, false)"
                            >
                            {{ marker.areaName }}
                    </l-popup>
                </l-marker>-->
            </l-map>
        </div>
    </div>
</template>
