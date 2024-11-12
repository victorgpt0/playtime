<?php
require 'load.php';
$ObjLayout->head_ownerdash('Dashboard');
$ObjLayout->navbar_userdash();
$ObjBody->searchbar();

?>
<head>
    <link rel="stylesheet" href="owner.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="https://js.arcgis.com/calcite-components/2.12.1/calcite.css" />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css">

</head>
<div class="container-fluid d-flex">
<div id="map2"></div>
</div>
<style>
    #map2 {
        height: 400px;
        width: 100%;
        margin-top: 20px;
    }

    #kontainer {
        margin-top: 20px;
        scroll-behavior: auto;
    }

    .collapsible-btn {
        background-color: #f1f1f1;
        color: #333;
        padding: 10px;
        text-align: left;
        border: none;
        border-radius: 10px;
        outline: none;
        font-size: 18px;
        width: 100%;
        cursor: pointer;
    }

    .collapsible-content {
        display: block;
    }

    .collapsible-content.hide {
        display: none;
        overflow: hidden;
        padding: 10px;
        transition: max-height 0.3s ease-out;
    }
    .edit-content{
        display: none;
        overflow: hidden;
        padding: 10px;
        transition: max-height 0.3s ease-out;
    }
    .edit-content.show{
        display: block;
    }
</style>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-vector@4.2.5/dist/esri-leaflet-vector.js"></script>
<script type="module" src="https://js.arcgis.com/calcite-components/2.12.1/calcite.esm.js"></script>
<script src="https://unpkg.com/@esri/arcgis-rest-request@4/dist/bundled/request.umd.js"></script>
<script src="https://unpkg.com/@esri/arcgis-rest-places@1/dist/bundled/places.umd.js"></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.js"></script>

<script src="js/captainmaps.js"></script>


<?php
$ObjBody->captain();
$ObjLayout->close_js();