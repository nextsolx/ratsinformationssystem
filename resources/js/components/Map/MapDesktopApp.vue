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
            marker: L.latLng(51.0025, 6.9299),
            icon: L.icon({
                iconUrl: './img/map_pin.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30]
            }),
            polygonColor: '#E1151B',
            display: 'district',
            areaValue: '',
            areaPreviousValue: '',
            areaType: 'city',
            markerList: [
                "Innenstadt","Rodenkirchen","Lindenthal","Ehrenfeld","Nippes","Chorweiler","Porz","Kalk","Mülheim"
            ]
        };
    },
    computed: {
        areaWithPolygon() {
            let leafletGeoFormat = [];
            if (areaData && this.areaValue) {
                for(let city in areaData) {
                    //console.log(areaData[city]);

                    if (areaData[city][this.areaValue] && areaData[city][this.areaValue].polygon[0]) {
                        //console.log('Chosen Area', areaData[city][this.areaValue].polygon[0]);

                        areaData[city][this.areaValue].polygon[0].map(geodata => {
                            leafletGeoFormat.push(geodata.slice().reverse());
                        });
                        return leafletGeoFormat;
                    }
                }
            } else {
                return [];
            }
        },
        areaWithPoint() {
            let allPointInSelectedArea = [];
            let latLngBoundArr = [];
            let latLngReversed = '';

            if (areaData) {
                for(let city in areaData) {
                    //console.log(areaData[city]);

                    for(let district in areaData[city]){
                        //console.log(district, areaData[city][district], areaData[city][district].point);
                        //console.log('Area type: ', this.areaType, this.areaValue);

                        if (this.areaValue && this.areaType === 'index') {
                            //console.log('new Area Point', this.areaValue, this.areaPreviousValue, this.areaType);

                            if (areaData[city][district][this.areaPreviousValue] &&
                                areaData[city][district][this.areaPreviousValue][this.areaValue]) {
                                //console.log('Chosen postcode: ', areaData[city][district][this.areaPreviousValue][this.areaValue].point);

                                latLngReversed = areaData[city][district][this.areaPreviousValue][this.areaValue].point.slice().reverse();
                                allPointInSelectedArea.push({
                                    latLng: latLngReversed,
                                    areaName: this.areaValue,
                                });

                                latLngBoundArr.push(latLngReversed);
                            }
                        } else if (this.areaValue && this.areaType === 'subdistrict') {
                            // @todo -- fix bug with go back link via Zur link
                            //console.log('new Area Point', this.areaValue, this.areaPreviousValue, this.areaType);

                            for (let subdistrict in areaData[city][district]) {
                                for (let postcode in areaData[city][district][subdistrict]) {
                                    if (subdistrict === this.areaValue && postcode !== 'point' && postcode !== 'polygon') {
                                        //console.log('Chosen postcode: ', postcode, areaData[city][district][subdistrict][postcode].point);

                                        latLngReversed = areaData[city][district][subdistrict][postcode].point.slice().reverse();
                                        allPointInSelectedArea.push({
                                            latLng: latLngReversed,
                                            areaName: postcode,
                                        });

                                        latLngBoundArr.push(latLngReversed);
                                    }
                                }
                            }
                        } else if (this.areaValue && this.areaType === 'district') {
                            //console.log('new Area Point', this.areaValue, this.areaPreviousValue, this.areaType);

                            for (let subdistrict in areaData[city][district]) {
                                if (district === this.areaValue && subdistrict !== 'point' && subdistrict !== 'polygon') {
                                    //console.log('Chosen subdistrict: ', subdistrict, areaData[city][district][subdistrict].point);

                                    latLngReversed = areaData[city][district][subdistrict].point.slice().reverse();
                                    allPointInSelectedArea.push({
                                        latLng: latLngReversed,
                                        areaName: subdistrict,
                                    });

                                    latLngBoundArr.push(latLngReversed);
                                }
                            }
                        } else if (this.areaType === 'city') {
                            if (areaData[city][district] && areaData[city][district].point) {

                                latLngReversed = areaData[city][district].point.slice().reverse();
                                allPointInSelectedArea.push({
                                    latLng: latLngReversed,
                                    areaName: district,
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

                return allPointInSelectedArea;
            } else {
                return [];
            }
        }
    },
    methods: {
        selectedArea ({ type, value }) {
            this.areaPreviousValue = this.areaValue;
            this.areaType = type;
            this.areaValue = value;
            console.log('Even was catch: ', type, value);
        },
        openPopup(e) {
            this.$nextTick(() => {
                e.target.openPopup();
            })
        },
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
        <MapAside class="ris-map-desktop-aside"
            @selectedArea="selectedArea"
        />
        <div id="map-desktop-osm" class="ris-map ris-map__desktop"
        >
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :zoomSnap="zoomSnap" :center="center"
            >
                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                        />
                <l-polygon @click="display = 'subdistrict'" v-if="display === 'district'"
                    :lat-lngs="areaWithPolygon"
                    :color="polygonColor"
                >
                    <l-popup>some text</l-popup>
                </l-polygon>
                <div v-for="marker in areaWithPoint">
                    <l-marker
                        :lat-lng="marker.latLng"
                        :icon="icon"
                        @add="openPopup"
                    >
                        <l-popup
                            :options="{ autoClose: false }"
                        >
                            {{ marker.areaName }}
                        </l-popup>
                    </l-marker>
                </div>
            </l-map>
        </div>
    </div>
</template>
