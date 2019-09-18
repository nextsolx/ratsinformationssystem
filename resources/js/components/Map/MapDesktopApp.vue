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
        area() {
            let allDataInSelectedArea = {'polygonList': [], 'pointList': []},
                latLngBoundArr = [],
                geodataReversed = '';

            if (areaData) {
                for (let city in areaData) {

                    if (this.areaValue && this.areaType === 'index') {
                        for (let district in areaData[city]) {

                            if (district && district in areaData[city]) {
                                for (let subdistrict in areaData[city][district]) {

                                    if (subdistrict in areaData[city][district]) {
                                        for (let postcode in areaData[city][district][subdistrict]) {

                                            if (+postcode === +this.areaValue &&
                                                postcode in areaData[city][district][subdistrict] &&
                                                postcode !== 'point' && postcode !== 'polygon') {

                                                let geodataTmp = [];
                                                areaData[city][district][subdistrict][postcode].polygon.map(geodataList => {
                                                    geodataList.map(geodata => {
                                                        geodataReversed = geodata.slice().reverse();
                                                        geodataTmp.push(geodataReversed);
                                                        geodataTmp.push(geodataReversed);
                                                    });
                                                });
                                                allDataInSelectedArea.polygonList.push(geodataTmp);
                                                latLngBoundArr.push(geodataTmp);

                                                if (postcode !== 'point' && postcode !== 'polygon') {
                                                    allDataInSelectedArea.pointList.push({
                                                        latLng: areaData[city][district][subdistrict][this.areaValue].point.slice().reverse(),
                                                        areaName: this.areaValue,
                                                        mobileInsideAreaType: 'index',
                                                    });
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else if (this.areaValue && this.areaType === 'subdistrict') {
                        for (let district in areaData[city]) {

                            if (district && district in areaData[city]) {
                                for (let subdistrict in areaData[city][district]) {

                                    if (subdistrict === this.areaValue &&
                                        subdistrict in areaData[city][district] &&
                                        subdistrict !== 'point' && subdistrict !== 'polygon') {

                                        let geodataTmp = [];
                                        areaData[city][district][subdistrict].polygon.map(geodataList => {
                                            geodataList.map(geodata => {
                                                geodataReversed = geodata.slice().reverse();
                                                geodataTmp.push(geodataReversed);
                                                geodataTmp.push(geodataReversed);
                                            });
                                        });
                                        allDataInSelectedArea.polygonList.push(geodataTmp);
                                        latLngBoundArr.push(geodataTmp);

                                        for (let postcode in areaData[city][district][this.areaValue]) {
                                            if (postcode !== 'point' && postcode !== 'polygon') {
                                                allDataInSelectedArea.pointList.push({
                                                    latLng: areaData[city][district][this.areaValue][postcode].point.slice().reverse(),
                                                    areaName: postcode,
                                                    mobileInsideAreaType: 'index',
                                                });
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else if (this.areaValue && this.areaType === 'district') {
                        if (this.areaValue in areaData[city] && areaData[city][this.areaValue].polygon[0]) {

                            let geodataTmp = [];
                            areaData[city][this.areaValue].polygon.map(geodataList => {
                                geodataList.map(geodata => {
                                    geodataReversed = geodata.slice().reverse();
                                    geodataTmp.push(geodataReversed);
                                    geodataTmp.push(geodataReversed);
                                });
                            });
                            allDataInSelectedArea.polygonList.push(geodataTmp);
                            latLngBoundArr.push(geodataTmp);

                            for (let subdistrict in areaData[city][this.areaValue]) {
                                if (subdistrict !== 'point' && subdistrict !== 'polygon') {
                                    allDataInSelectedArea.pointList.push({
                                        latLng: areaData[city][this.areaValue][subdistrict].point.slice().reverse(),
                                        areaName: subdistrict,
                                        mobileInsideAreaType: 'subdistrict',
                                    });
                                }
                            }
                        }
                    } else if (this.areaType === 'city') {
                        for (let district in areaData[city]) {

                            if (areaData[city][district] && areaData[city][district].point) {
                                let latLngReversed = areaData[city][district].point.slice().reverse();
                                allDataInSelectedArea.pointList.push({
                                    latLng: latLngReversed,
                                    areaName: district,
                                    mobileInsideAreaType: 'district',
                                });

                                latLngBoundArr.push(latLngReversed);
                            }
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

            return allDataInSelectedArea;
        },
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
                <l-polygon v-if="area && area.polygonList"
                    :lat-lngs="area.polygonList"
                    :color="primaryColor"
                        />
                <l-marker
                    v-for="(marker, index) in area.pointList"
                    :key="index"
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
            </l-map>
        </div>
    </div>
</template>
