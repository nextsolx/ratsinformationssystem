<script>
import L from 'leaflet';
import { LMap, LTileLayer, LPopup, LPolygon, LMarker } from 'vue2-leaflet';
import MapAside from './MapAside';
require('leaflet-fullscreen');

import cityData from '../../api/city.json';
import districtListData from '../../api/districts.json';
import subdistrictListData from '../../api/subdistricts.json';

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
            areaName: '',
            areaType: 'city',


            activeDistrict: null,
            hoveredDistrict: null,
            activeSubdistrict: null,
            hoveredSubdistrict: null,
        };
    },
    computed: {
        subdistrictList() {
            if (this.activeSubdistrict) {
                return this.areaSubdistrict.polygonList.filter(sub => sub.areaName === this.activeSubdistrict)
            } else if (this.activeDistrict) {
                return this.areaSubdistrict.polygonList.filter(sub => sub.areaParentName === this.activeDistrict)
            } else {
                return this.areaSubdistrict.polygonList;
            }
        },
        districtList() {
            return this.activeDistrict ? this.areaDistrict.polygonList.filter(d => d.areaName === this.activeDistrict) : this.areaDistrict.polygonList;
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

            //:color="!hoveredSubdistrict && checkDistrict(polygon.areaName) ? primaryColor : secondaryColor"
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
        getZoomData(areaType, areaName) {
            let areaInner = {polygonList: [], pointList: [], latLngBound: []},
                areaListData;
            areaName = this.areaNameNormalize(areaName);

            if (areaType === 'district') {
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
            return areaName ? areaName.replace(/-/i, '/') : null;
        },
        selectDistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);
            this.activeDistrict = areaName;

            // zoom to the new location
            const zoomData = this.getZoomData('district', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);

            Bus.$emit('district-selected', areaName);

            // update navigation
            //Bus.$emit('mapOut', {type: 'district', value: areaName});
        },
        handleDistrict(areaName) {
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

            Bus.$emit('subdistrict-selected', areaName);
            // console.log('mapOut', areaName);
            // update navigation
            //Bus.$emit('mapOut', {type: 'subdistrict', value: areaName});
        },
        handleSubdistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);
            this.hoveredSubdistrict = areaName;
        },
        checkSubdistrict(areaName) {
            areaName = this.areaNameNormalize(areaName);

            return areaName === this.activeSubdistrict || areaName === this.hoveredSubdistrict;
        },
        selectByNavigation(areaType, areaName) {
            if (areaType === 'district') {
                this.selectDistrict(areaName);
            } else if (areaType === 'subdistrict') {
                this.selectSubdistrict(areaName);
            }
        },
        handleByNavigation(areaType, areaName) {
            if (areaType === 'district') {
                this.handleDistrict(areaName);
            } else if (areaType === 'subdistrict') {
                this.handleSubdistrict(areaName);
            }
        },
    },
    created() {
        Bus.$on('select-district', areaName => {
            areaName = this.areaNameNormalize(areaName);
            this.activeDistrict = areaName;
            this.activeSubdistrict = null;

            // zoom to the new location
            const zoomData = this.getZoomData('district', areaName);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });

        Bus.$on('select-map', () => {
            this.activeDistrict = null;
            this.activeSubdistrict = null;
        });

        Bus.$on('mapIn', ({ type, value: name }) => {
            this.areaType = type;
            this.areaName = name;
            console.log('mapIn', type, name);

            if (type === 'district') {
                this.selectDistrict(name);
                this.activeSubdistrict = null;
                this.hoveredSubdistrict = null;
            } else if (type === 'subdistrict') {
                this.selectSubdistrict(name);

            } else {
                // type city
                this.activeDistrict = null;
                this.hoveredDistrict = null;
                this.activeSubdistrict = null;
                this.hoveredSubdistrict = null;
            }

            const zoomData = this.getZoomData(type, name);
            this.zoomToSelectedArea(zoomData.latLngBound);
        });
    },
    mounted() {
        this.areaCity = this.getCityPolygonList();
        this.areaDistrict = this.getDistrictPolygonList();
        this.areaSubdistrict = this.getSubdistrictPolygonList();

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
            @mouse-handle="handleByNavigation($event.type, $event.name)"
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
                <!--:fill-opacity="activeDistrict ? 0.01 : .2"-->

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

                    @mouseover="handleDistrict(polygon.areaName)"
                    @mouseleave="handleDistrict(null)"

                    @click="selectDistrict(polygon.areaName)"
                />

                <!--subdistrict-->
                <l-polygon
                    v-if="activeDistrict"

                    :color="checkSubdistrict(polygon.areaName) ? primaryColor : secondaryColor"

                    :fill-color="fillColor"
                    :weight="weightPolygon"
                    v-for="(polygon, index) in subdistrictList"
                    :key="`${index}-${polygon.areaName}-subdistrict`"
                    :lat-lngs="polygon.latLngs"

                    :fill-opacity="checkSubdistrict(polygon.areaName) ? .2 : .01"
                    :stroke="checkSubdistrict(polygon.areaName)"

                    @mouseover="handleSubdistrict(polygon.areaName)"
                    @mouseleave="handleSubdistrict(null)"

                    @click="selectSubdistrict(polygon.areaName)"
                />


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
