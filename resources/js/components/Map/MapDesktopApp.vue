<script>
import L from 'leaflet';
import { LMap, LTileLayer, LPopup, LPolygon, LMarker } from 'vue2-leaflet';
import MapDesktopAside from './MapDesktopAside';
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
        MapDesktopAside,
    },
    data() {
        return {
            zoom: 12,
            center: L.latLng(50.9360, 6.9602),
            url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            icon: L.icon({
                iconUrl: './img/map_pin.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30]
            }),
            polygonChild: {
                latlngs: [
                    [51.0025, 6.9299],
                    [51.0025, 6.9489],
                    [51.0060, 6.9389],
                    [51.0135, 6.9299],
                ],
            },
            polygonColor: '#E1151B',
            display: 'district',
            areaValue: '',
            areaType: 'all',
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
            if (areaData) {
                for(let city in areaData) {
                    //console.log(areaData[city]);

                    for(let district in areaData[city]){
                        //console.log(district, areaData[city][district], areaData[city][district].point);
                        //console.log('Area type: ', this.areaType);
                        let areaDataPoint = '';

                        if (this.areaValue && this.areaType === 'district') {
                            //console.log('new Area Point', this.areaValue, this.areaType, areaData[city][district]);

                            for (let subdistrict in areaData[city][district]) {
                                if (district === this.areaValue && subdistrict !== 'point' && subdistrict !== 'polygon') {
                                    console.log('Subdistrict: ', subdistrict, areaData[city][district][subdistrict].point);

                                    areaDataPoint = areaData[city][district][subdistrict].point.slice().reverse();

                                    allPointInSelectedArea.push({
                                        latLng: areaDataPoint,
                                        areaName: subdistrict,
                                    });
                                }
                            }
                        } else {
                            if (areaData[city][district] && areaData[city][district].point) {

                                areaDataPoint = areaData[city][district].point.slice().reverse();

                                allPointInSelectedArea.push({
                                    latLng: areaDataPoint,
                                    areaName: district,
                                });
                            }
                        }
                    }
                }

                if (this.areaType === 'all') {
                    this.zoom = 12;
                } else if (this.areaType === 'district') {
                    this.zoom = 13;
                }

                return allPointInSelectedArea;
            } else {
                return [];
            }
        }
    },
    methods: {
        selectedArea ({ type, value }) {
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
        <MapDesktopAside class="ris-map-desktop-aside"
            @selectedArea="selectedArea"
        />
        <div id="map-desktop-osm" class="ris-map ris-map__desktop"
        >
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :center="center"
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
                <l-polygon @click="display = 'district'" v-if="display === 'subdistrict'"
                    :lat-lngs="polygonChild.latlngs"
                    :color="polygonColor"
                >
                    <l-popup>another text</l-popup>
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
