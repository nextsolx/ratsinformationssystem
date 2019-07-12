<script>
import L from 'leaflet';
import { LMap, LTileLayer, LMarker, LPopup } from 'vue2-leaflet';
require('leaflet-fullscreen');

export default {
    name: 'MapMobileApp',
    components: { LMap, LTileLayer, LMarker, LPopup },
    data() {
        return {
            zoom: 10,
            center: L.latLng(50.9360, 6.9602),
            url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            marker: L.latLng(50.9386, 6.9597),
            icon: L.icon({
                iconUrl: './img/map_pin.svg',
                iconSize: [48, 55],
                iconAnchor: [24, 55],
                popupAnchor: [0, -30]
            }),
            markerPopupText: 'Hello World'
        };
    },
    mounted() {
        this.$nextTick(() => {
            this.$refs.mapMobileOsm.mapObject.addControl(new L.Control.Fullscreen());
        });
    }
};
</script>

<template>
    <div id="map-mobile-osm" class="ris-map ris-map__mobile">
        <l-map ref="mapMobileOsm"
               :zoom="zoom" :center="center">
            <l-tile-layer
                :url="url"
                :attribution="attribution"
                    />
            <l-marker
                :lat-lng="marker"
                :icon="icon"
                    >
                <l-popup> {{ markerPopupText }} </l-popup>
            </l-marker>
        </l-map>
    </div>
</template>