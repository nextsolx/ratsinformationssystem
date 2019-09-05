<script>
import L from 'leaflet';
import { LMap, LTileLayer, LMarker, LPopup, LPolygon } from 'vue2-leaflet';
import MapDesktopAside from './MapDesktopAside';
require('leaflet-fullscreen');

export default {
    name: 'MapDesktopApp',
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
        LPolygon,
        MapDesktopAside
    },
    data() {
        return {
            zoom: 11,
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
            markerPopupText: 'Hello World',
            polygon: {
                latlngs: [
                    [51.0025, 6.9299],
                    [51.0025, 6.9489],
                    [51.0135, 6.9489],
                    [51.0135, 6.9299],
                ],
                color: '#ff00ff'
            },
            polygonChild: {
                latlngs: [
                    [51.0025, 6.9299],
                    [51.0025, 6.9489],
                    [51.0060, 6.9389],
                    [51.0135, 6.9299],
                ],
                color: '#ff00ff'
            },
            display: 'district'
        };
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
        <MapDesktopAside class="ris-map-desktop-aside"/>
        <div id="map-desktop-osm" class="ris-map ris-map__desktop">
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :center="center">
                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                        />
                <l-polygon @click="display = 'subdistrict'" v-if="display === 'district'" :lat-lngs="polygon.latlngs" :color="polygon.color">
                    <l-popup>some text</l-popup>
                </l-polygon>
                <l-polygon @click="display = 'district'" v-if="display === 'subdistrict'" :lat-lngs="polygonChild.latlngs" :color="polygon.color">
                    <l-popup>another text</l-popup>
                </l-polygon>
            </l-map>
        </div>
    </div>
</template>
