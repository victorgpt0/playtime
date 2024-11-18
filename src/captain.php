<?php
require 'load.php';
$ObjLayout->head_ownerdash('Dashboard');
$ObjLayout->navbar_userdash();
$ObjBody->searchbar($facilityType);

?>
<head>
    <link rel="stylesheet" href="owner.css">
    <link rel="stylesheet" href="../assets/css/landingpage.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="https://js.arcgis.com/calcite-components/2.12.1/calcite.css" />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css">

</head>
<div class="container-fluid d-flex">
<div id="map2" class="collapsible-content"></div>
</div>
</form>
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
    /* background-color: #000;
    color: #fff; */
    /* width: 10%; */
    cursor: pointer;
}
/* .collapsible-btn:hover{
    color:black;
    background-color:grey;
} */


.collapsible-content {
    display: none;
    overflow: hidden;
    padding: 10px;
    transition: max-height 0.3s ease-out;
}

.collapsible-content.show {
    display: block;
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



<?php
if(isset($_SESSION['user'])){
    $userLocations=[];
    if(!empty($facilityCard_captain)){
    foreach($facilityCard_captain as $card){
        $userLocations[]=[
            'lat' => floatval($card['latitude']),
            'lng' => floatval($card['longitude']),
            'name' => $card['place_id'],
            'facilityName'=>$card['name'],
            'facilityId'=>$card['facilityId'],
            'price'=>$card['price_per_hour'],
            'type'=>$card['type'],
            'status'=>$card['status']
        ];
    }
}

}
$searchResults = $ObjCaptain->search($conn);
$ObjBody->captain($searchResults);
$ObjLayout->close_js();
?>

<script src="js/captainmaps.js"></script>
<script>
    const userLocations=<?=json_encode($userLocations)?>;
    console.log(userLocations);
    markLocations(userLocations);

    function toggleContent(id) {
        const content = document.getElementById(id);
        content.classList.toggle("show");
        if (id === 'map2' && content.classList.contains('show')) {
        // Small delay to ensure the container is fully visible
        setTimeout(() => {
            if (map) {
                map.invalidateSize();
            }
        }, 100);
    }
    }
</script>

