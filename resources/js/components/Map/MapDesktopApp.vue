<script>
import L from 'leaflet';
import { LMap, LTileLayer, LPopup, LPolygon, LMarker } from 'vue2-leaflet';
import MapAside from './MapAside';
require('leaflet-fullscreen');

//import areaData from '../../api/districts.js';
import location from '../../api/location.js';

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
            fillColor: '#8c8c8c',
            weightPolygon: 2,
            area: '',
            areaParentPolygonList: [],
            areaName: '',
            areaType: 'city',
        };
    },
    methods: {
        getPolygonAndPointList() {

        },
        getPolygonAndPointListOld(areaTypeParam, areaNameParam, areaPolygonFillOpacity = .001, areaPolygonStroke = false, mouseAction = 'leave') {
            let allDataInSelectedArea = {'polygonList': [], 'pointList': [], 'latLngBound': []},
                geodataReversed = '';

            if (areaData) {
                for (let city in areaData) {

                    if (areaNameParam && areaTypeParam === 'index') {
                        for (let district in areaData[city]) {

                            if (district && district in areaData[city]) {
                                for (let subdistrict in areaData[city][district]) {

                                    if (subdistrict in areaData[city][district]) {
                                        for (let postcode in areaData[city][district][subdistrict]) {

                                            if (+postcode === +areaNameParam &&
                                                postcode in areaData[city][district][subdistrict] &&
                                                postcode !== 'point' && postcode !== 'polygon') {

                                                // lat lng for polygonList
                                                let geodataTmp = [];
                                                areaData[city][district][subdistrict][postcode].polygon.map(geodataList => {
                                                    geodataList.map(geodata => {
                                                        geodataReversed = geodata.slice().reverse();
                                                        geodataTmp.push(geodataReversed);
                                                    });
                                                });

                                                // lat lng for pointList and areaName for polygonList
                                                if (postcode !== 'point' && postcode !== 'polygon') {
                                                    // lat lng for pointList
                                                    allDataInSelectedArea.pointList.push({
                                                        latLng: areaData[city][district][subdistrict][areaNameParam].point.slice().reverse(),
                                                        areaName: areaNameParam,
                                                        mobileInsideAreaType: null,
                                                    });

                                                    // areaName for polygonList
                                                    allDataInSelectedArea.polygonList.push({
                                                        latLngs: geodataTmp,
                                                        areaName: areaNameParam,
                                                        stroke: areaPolygonStroke,
                                                        fillOpacity: areaPolygonFillOpacity,
                                                    });
                                                }

                                                // future zoom to current lat lng
                                                allDataInSelectedArea.latLngBound.push(geodataTmp);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else if (areaNameParam && areaTypeParam === 'subdistrict') {
                        for (let district in areaData[city]) {

                            if (district && district in areaData[city]) {
                                for (let subdistrict in areaData[city][district]) {

                                    if (subdistrict === areaNameParam &&
                                        subdistrict in areaData[city][district] &&
                                        subdistrict !== 'point' && subdistrict !== 'polygon') {

                                        // lat lng for polygonList
                                        let geodataTmp = [];
                                        areaData[city][district][subdistrict].polygon.map(geodataList => {
                                            geodataList.map(geodata => {
                                                geodataReversed = geodata.slice().reverse();
                                                geodataTmp.push(geodataReversed);
                                            });
                                        });

                                        // lat lng for pointList and areaName for polygonList
                                        for (let postcode in areaData[city][district][areaNameParam]) {
                                            if (postcode !== 'point' && postcode !== 'polygon') {
                                                // lat lng for pointList
                                                allDataInSelectedArea.pointList.push({
                                                    latLng: areaData[city][district][areaNameParam][postcode].point.slice().reverse(),
                                                    areaName: postcode,
                                                    mobileInsideAreaType: 'index',
                                                });

                                                // areaName for polygonList
                                                allDataInSelectedArea.polygonList.push({
                                                    latLngs: geodataTmp,
                                                    areaName: postcode,
                                                    stroke: areaPolygonStroke,
                                                    fillOpacity: areaPolygonFillOpacity,
                                                });
                                            }
                                        }

                                        // future zoom to current lat lng
                                        allDataInSelectedArea.latLngBound.push(geodataTmp);
                                    }
                                }
                            }
                        }
                    } else if (areaNameParam && areaTypeParam === 'district') {
                        if (areaNameParam in areaData[city] && areaData[city][areaNameParam].polygon[0]) {

                            // lat lng for polygonList
                            let geodataTmp = [];
                            areaData[city][areaNameParam].polygon.map(geodataList => {
                                geodataList.map(geodata => {
                                    geodataReversed = geodata.slice().reverse();
                                    geodataTmp.push(geodataReversed);
                                });
                            });

                            // lat lng for pointList and areaName for polygonList
                            for (let subdistrict in areaData[city][areaNameParam]) {
                                if (subdistrict !== 'point' && subdistrict !== 'polygon') {
                                    // lat lng for pointList
                                    allDataInSelectedArea.pointList.push({
                                        latLng: areaData[city][areaNameParam][subdistrict].point.slice().reverse(),
                                        areaName: subdistrict,
                                        mobileInsideAreaType: 'subdistrict',
                                    });

                                    // areaName for polygonList
                                    allDataInSelectedArea.polygonList.push({
                                        latLngs: geodataTmp,
                                        areaName: subdistrict,
                                        stroke: areaPolygonStroke,
                                        fillOpacity: areaPolygonFillOpacity,
                                    });
                                }
                            }

                            // future zoom to current lat lng
                            allDataInSelectedArea.latLngBound.push(geodataTmp);
                        }
                    } else if (areaTypeParam === 'city') {
                        //if (areaNameParam in areaData[city] && areaData[city][areaNameParam].polygon[0]) {

                        for (let district in areaData[city]) {
                            console.log('Get City: ', city, district, areaNameParam);

                            if (district && mouseAction === 'over') {
                                console.log(mouseAction, district, areaNameParam);
                                district = areaNameParam;
                            }

                            if (areaData[city][district] && areaData[city][district].point) {

                                // lat lng for polygonList
                                let geodataTmp = [];
                                areaData[city][district].polygon.map(geodataList => {
                                    geodataList.map(geodata => {
                                        geodataReversed = geodata.slice().reverse();
                                        geodataTmp.push(geodataReversed);
                                    });
                                });
                                // areaName for polygonList
                                allDataInSelectedArea.polygonList.push({
                                    areaName: district,
                                    latLngs: geodataTmp,
                                    stroke: areaPolygonStroke,
                                    fillOpacity: areaPolygonFillOpacity,
                                });

                                // lat lng for pointList
                                let latLngReversed = areaData[city][district].point.slice().reverse();
                                allDataInSelectedArea.pointList.push({
                                    areaName: district,
                                    latLng: latLngReversed,
                                    mobileInsideAreaType: 'city',
                                });

                                // future zoom to current lat lng
                                allDataInSelectedArea.latLngBound.push(latLngReversed);
                            }
                        }
                    }
                }
            }

            return allDataInSelectedArea;
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
        showArea(type, name, opacity, stroke, mouseAction) {
            if (type) {
                console.log(type, name, mouseAction);

                /*if (showHide === 'show') {
                    const areaData = this.getPolygonAndPointList(type, name, opacity, stroke, mouseAction);
                    if (this.area && this.area.polygonList && areaData) {
                        // show child only polygon area
                        this.area.polygonList = areaData.polygonList;

                        this.areaParentPolygonList = this.area.polygonList;
                        //this.area.polygonList = [];
                    }
                } else {
                    if (this.area && this.area.polygonList) {
                        // hide child polygon area
                        this.area.polygonList = [];
                    }
                }*/
            }
        },
        selectedArea({ type, name }) {
            if (type) {
                this.areaType = type;
                this.areaName = name;
                this.area = this.getPolygonAndPointList(type, name);
                this.zoomToSelectedArea(this.area.latLngBound);

                /*if (type === 'city') {
                    this.areaParentPolygonList = [];
                } else {
                    if (this.area && this.area.polygonList) {
                        this.areaParentPolygonList = this.area.polygonList;
                        this.area.polygonList = [];
                    }
                }*/

                Bus.$emit('mapOut', {type, value: name});
            }
        },
        openPopup(e) {
            this.$nextTick(() => {
                e.target.openPopup();
            });
        },
    },
    created() {
        Bus.$on('mapIn', ({ type, value: name }) => {
            this.areaType = type;
            this.areaName = name;
            this.area = this.getPolygonAndPointList(type, name);
            this.zoomToSelectedArea(this.area.latLngBound);

            /*if (this.area && this.area.polygonList) {
                this.areaParentPolygonList = this.area.polygonList;
                this.area.polygonList = [];
            }*/
        });
    },
    async mounted() {
        const city = await location.getDistrictsByAPI();
        console.log(city);

        /*this.area = this.getPolygonAndPointList(this.areaType, this.areaName);
        this.zoomToSelectedArea(this.area.latLngBound);

        if (this.area && this.area.polygonList) {
            console.log('MOUNTED. first init - area and areaParent');
            this.areaParentPolygonList = this.area.polygonList;
            this.area.polygonList = [];
        }

        this.$nextTick(() => {
            this.$refs.mapDesktopOsm.mapObject.addControl(new L.Control.Fullscreen());
        });*/
    }
};
</script>

<template>
    <div>
        <MapAside @show-area="showArea($event.type, $event.name, $event.opacity, $event.stroke)" class="ris-map-desktop-aside"/>
        <div id="map-desktop-osm" class="ris-map ris-map__desktop"
                >
            <l-map ref="mapDesktopOsm"
                :zoom="zoom" :zoom-snap="zoomSnap" :center="center"
                    >
                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                        />
                <l-polygon
                    :color="primaryColor"
                    :fill-color="fillColor"
                    :weight="weightPolygon"
                    :bubblingMouseEvents="false"
                    v-for="(polygon, index) in area.polygonList"
                    :key="`${index}-${polygon.areaName}-child`"
                    :lat-lngs="polygon.latLngs"
                    :fill-opacity="polygon.fillOpacity"
                    :stroke="polygon.stroke"
                    @mouseover="polygon.fillOpacity = .5, polygon.stroke = true"
                    @mouseleave="polygon.fillOpacity = .01, polygon.stroke = false"
                        />
                <!--display area data for init of page for main city district-->
                <!--<l-polygon
                    :color="secondaryColor"
                    :fill-color="fillColor"
                    :weight="weightPolygon"
                    :bubblingMouseEvents="false"
                    v-for="(polygon, index) in areaParentPolygonList"
                    :key="`${index}-${polygon.areaName}-parent`"
                    :lat-lngs="polygon.latLngs"
                    :fill-opacity="polygon.fillOpacity"
                    :stroke="polygon.stroke"
                    @mouseeover="polygon.fillOpacity = .5, polygon.stroke = true"
                    @mouseleave="polygon.fillOpacity = .01, polygon.stroke = false"
                        />-->
                <l-marker
                    v-for="(marker, index) in area.pointList"
                    :key="index"
                    :lat-lng="marker.latLng"
                    :icon="icon"
                    @add="openPopup"
                        >
                    <l-popup
                        :options="{ autoClose: false }"
                        @click.native="selectedArea({ type: marker.mobileInsideAreaType, name: marker.areaName })"
                        @mouseover.native="showArea(marker.mobileInsideAreaType, marker.areaName, .5, true, 'over')"
                        @mouseleave.native="showArea(marker.mobileInsideAreaType, marker.areaName, .01, false, 'leave')"
                            >
                            {{ marker.areaName }}
                    </l-popup>
                </l-marker>
            </l-map>
        </div>
    </div>
</template>
