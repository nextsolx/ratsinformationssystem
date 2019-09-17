<script>
import L from 'leaflet';
import { LMap, LTileLayer, LPopup, LPolygon, LMarker } from 'vue2-leaflet';
import MapAside from './MapAside';
require('leaflet-fullscreen');

import areaData from '../../api/districts.js';

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
            areaValue: '',
            areaPreviousValue: '',
            areaType: 'city',
            markerList: [
                'Innenstadt','Rodenkirchen','Lindenthal','Ehrenfeld','Nippes','Chorweiler','Porz','Kalk','Mülheim'
            ],
        };
    },
    computed: {
        areaWithPolygon() {
            let allPolygonInSelectedArea = [],
                latLngBoundArr = [],
                geodataReversed = '';

            if (areaData) {
                for (let city in areaData) {

                    if (this.areaValue && this.areaType === 'index') {
                        for (let district in areaData[city]) {

                            if (district && Object.prototype.hasOwnProperty.call(areaData[city], district)) {
                                for (let subdistrict in areaData[city][district]) {

                                    if (Object.prototype.hasOwnProperty.call(areaData[city][district], subdistrict)) {
                                        for (let postcode in areaData[city][district][subdistrict]) {

                                            if (parseInt(postcode, 10) === this.areaValue &&
                                                Object.prototype.hasOwnProperty.call(areaData[city][district][subdistrict], postcode) &&
                                                postcode !== 'point' && postcode !== 'polygon') {

                                                // @todo - there are problems with plural polygon draw,
                                                // the postcode can not be the same in different subdistrict

                                                areaData[city][district][subdistrict][postcode].polygon[0].map(geodata => {
                                                    geodataReversed = geodata.slice().reverse();
                                                    allPolygonInSelectedArea.push(geodataReversed);
                                                    latLngBoundArr.push(geodataReversed);
                                                });
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else if (this.areaValue && this.areaType === 'subdistrict') {
                        for (let district in areaData[city]) {

                            if (district && Object.prototype.hasOwnProperty.call(areaData[city], district)) {
                                for (let subdistrict in areaData[city][district]) {

                                    if (subdistrict === this.areaValue &&
                                        Object.prototype.hasOwnProperty.call(areaData[city][district], subdistrict) &&
                                        subdistrict !== 'point' && subdistrict !== 'polygon') {

                                        areaData[city][district][subdistrict].polygon[0].map(geodata => {
                                            geodataReversed = geodata.slice().reverse();
                                            allPolygonInSelectedArea.push(geodataReversed);
                                            latLngBoundArr.push(geodataReversed);
                                        });
                                    }
                                }
                            }
                        }
                    } else if (this.areaValue && this.areaType === 'district') {
                        if (Object.prototype.hasOwnProperty.call(areaData[city], this.areaValue) && areaData[city][this.areaValue].polygon[0]) {

                            areaData[city][this.areaValue].polygon[0].map(geodata => {
                                geodataReversed = geodata.slice().reverse();
                                allPolygonInSelectedArea.push(geodataReversed);
                                latLngBoundArr.push(geodataReversed);
                            });
                        }
                    }
                }

                if (latLngBoundArr.length > 0) {
                    this.$nextTick(() => {
                        // align and zoom by center of markers
                        let markerBounds = L.latLngBounds(latLngBoundArr);
                        this.$refs.mapDesktopOsm.mapObject.fitBounds(markerBounds);
                    });
                }
            }

            return allPolygonInSelectedArea;
        },
        areaWithPoint() {
            let allPointInSelectedArea = [],
                latLngBoundCityArr = [],
                latLngReversed = '';

            if (areaData) {
                for(let city in areaData) {

                    for (let district in areaData[city]) {
                        if (Object.prototype.hasOwnProperty.call(areaData[city], district)) {

                            if (this.areaValue && this.areaType === 'index') {

                                if (areaData[city][district][this.areaPreviousValue] &&
                                    areaData[city][district][this.areaPreviousValue][this.areaValue]) {

                                    latLngReversed = areaData[city][district][this.areaPreviousValue][this.areaValue].point.slice().reverse();
                                    allPointInSelectedArea.push({
                                        latLng: latLngReversed,
                                        areaName: this.areaValue,
                                        mobileInsideAreaType: 'city', // go to district list from index only for the mobile version
                                    });

                                    if (this.$refs.mapDesktopOsm.mapObject) {
                                        this.$refs.mapDesktopOsm.mapObject.setView(
                                            latLngReversed, this.$refs.mapDesktopOsm.mapObject.getZoom() + 1
                                        );
                                    }
                                }
                            } else if (this.areaValue && this.areaType === 'subdistrict') {
                                for (let subdistrict in areaData[city][district]) {

                                    if (Object.prototype.hasOwnProperty.call(areaData[city][district], subdistrict)) {
                                        for (let postcode in areaData[city][district][subdistrict]) {

                                            if (subdistrict === this.areaValue &&
                                                Object.prototype.hasOwnProperty.call(areaData[city][district][subdistrict], postcode) &&
                                                postcode !== 'point' && postcode !== 'polygon') {

                                                latLngReversed = areaData[city][district][subdistrict][postcode].point.slice().reverse();
                                                allPointInSelectedArea.push({
                                                    latLng: latLngReversed,
                                                    areaName: postcode,
                                                    mobileInsideAreaType: 'index',
                                                });
                                            }
                                        }
                                    }
                                }
                            } else if (this.areaValue && this.areaType === 'district') {
                                for (let subdistrict in areaData[city][district]) {

                                    if (district === this.areaValue &&
                                        Object.prototype.hasOwnProperty.call(areaData[city][district], subdistrict) &&
                                        subdistrict !== 'point' && subdistrict !== 'polygon') {

                                        latLngReversed = areaData[city][district][subdistrict].point.slice().reverse();
                                        allPointInSelectedArea.push({
                                            latLng: latLngReversed,
                                            areaName: subdistrict,
                                            mobileInsideAreaType: 'subdistrict',
                                        });
                                    }
                                }
                            } else if (this.areaType === 'city') {
                                if (areaData[city][district] && areaData[city][district].point) {

                                    latLngReversed = areaData[city][district].point.slice().reverse();
                                    allPointInSelectedArea.push({
                                        latLng: latLngReversed,
                                        areaName: district,
                                        mobileInsideAreaType: 'district',
                                    });

                                    latLngBoundCityArr.push(latLngReversed);
                                }
                            }
                        }
                    }
                }

                if (this.areaType === 'city' && latLngBoundCityArr.length > 0) {
                    this.$nextTick(() => {
                        // align and zoom by center of markers
                        let markerBounds = L.latLngBounds(latLngBoundCityArr);
                        this.$refs.mapDesktopOsm.mapObject.fitBounds(markerBounds);
                    });
                }
            }

            return allPointInSelectedArea;
        }
    },
    methods: {
        selectedArea ({ type, value }) {
            this.areaPreviousValue = this.areaValue;
            this.areaType = type;
            this.areaValue = value;
            Bus.$emit('mapOut', { type, value });
        },
        openPopup(e) {
            this.$nextTick(() => {
                e.target.openPopup();
            });
        },
    },
    created () {
        Bus.$on('mapIn', ({ type, value }) => {
            console.log('mapIn',{ type, value });
            this.areaPreviousValue = this.areaValue;
            this.areaType = type;
            this.areaValue = value;
        });
    },
    mounted() {
        this.$nextTick(() => {
            this.$refs.mapDesktopOsm.mapObject.addControl(new L.Control.Fullscreen());
        });
    }
};
</script>

<template>
    <div>
        <MapAside class="ris-map-desktop-aside"/>
        <div id="map-desktop-osm" class="ris-map ris-map__desktop"
                >
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :zoom-snap="zoomSnap" :center="center"
                    >
                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                        />
                <l-polygon v-if="areaWithPolygon"
                    :lat-lngs="areaWithPolygon"
                    :color="primaryColor"
                        />
                <div v-for="marker in areaWithPoint"
                    :key="marker.areaName"
                        >
                    <l-marker
                        :lat-lng="marker.latLng"
                        :icon="icon"
                        @add="openPopup"
                            >
                        <l-popup
                            :options="{ autoClose: false }"
                            @click.native="selectedArea({ type: marker.mobileInsideAreaType, value: marker.areaName})"
                                >
                            {{ marker.areaName }}
                        </l-popup>
                    </l-marker>
                </div>
            </l-map>
        </div>
    </div>
</template>
