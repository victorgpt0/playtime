<?php
require 'load.php';
$ObjLayout->head_ownerdash('Facilities');
?>

<head>
    <link rel="stylesheet" href="owner.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="https://js.arcgis.com/calcite-components/2.12.1/calcite.css" />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css">

</head>
<?php
$ObjLayout->navbar_ownerdash();

?>


<div class="container" id="main-content">



<button class="collapsible-btn" onclick="toggleContent('formContent')"><h2>Add New Sports Facility</h2><h5>(Click to Expand)</h5></button>
    <div class="collapsible-content" id="formContent">
        <div class="form-section">
            <form action="<?php print basename($_SERVER['PHP_SELF']); ?>" method="post" id="addFacilityForm">
                <label for="facilityName">Facility Name:</label>
                <input type="text" id="facilityName" name="facilityName" placeholder="Madaraka Football Arena#1" value="<?php print isset($_SESSION['facilityName']) ? $_SESSION['facilityName'] : '';
                                                                                                                        unset($_SESSION['facilityName']); ?>">

                <label for="facilityType">Facility Type:</label>
                <select id="facilityType" name="facilityType" onchange="checkOtherOption()">
                    <option value="0" <?php print isset($_SESSION['facilityType']) && $_SESSION['facilityType'] === '0' ? 'selected' : ''; ?>>Select a Pitch...</option>
                    <?php
                    // print_r($facilityType);
                    foreach ($facilityType as $row) {
                        echo '<option value="' . $row['typeId'] . '" ' . (isset($_SESSION['facilityType']) && $_SESSION['facilityType'] === strval($row['typeId']) ? 'selected' : '') . '>' . $row['type'] . '</option>';
                    }
                    ?>
                    <option value="Other" <?php print isset($_SESSION['facilityType']) && $_SESSION['facilityType'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>

                <div id="otherFacility" style="display: <?php echo (isset($_SESSION['facilityType']) && $_SESSION['facilityType'] === 'Other') ? 'block' : 'none';
                                                        unset($_SESSION['facilityType']); ?>;">
                    <label for="otherFacilityType"><b>Please specify</b></label>
                    <input type="text" id="otherFacilityType" name="otherFacilityType" value="<?php print isset($_SESSION['otherFacilityType']) ? $_SESSION['otherFacilityType'] : '';
                                                                                                unset($_SESSION['otherFacilityType']); ?>">
                </div>

                <label for="description">Description</label>
                <input type="textarea" name="description" placeholder="7-a-side Football Turf" value="<?php print isset($_SESSION['description']) ? $_SESSION['description'] : '';
                                                                                                        unset($_SESSION['description']); ?>">

                <label for="facilityPrice">Price per Hour:</label>
                <input type="number" id="facilityPrice" name="facilityPrice" placeholder="1500" value="<?php print isset($_SESSION['facilityPrice']) ? $_SESSION['facilityPrice'] : '';
                                                                                                        unset($_SESSION['facilityPrice']); ?>">

                <input type="hidden" id="facilityLat" name="latitude" placeholder="Latitude" value="<?php print isset($_SESSION['latitude']) ? $_SESSION['latitude'] : '';
                                                                                                    unset($_SESSION['latitude']); ?>" readonly />
                <input type="hidden" id="facilityLng" name="longitude" placeholder="Longitude" value="<?php print isset($_SESSION['longitude']) ? $_SESSION['longitude'] : '';
                                                                                                        unset($_SESSION['longitude']); ?>" readonly />
                <input type="text" id="facilityAddress" name="address" value="<?php print isset($_SESSION['address']) ? $_SESSION['address'] : '';
                                                                                unset($_SESSION['address']); ?>" placeholder="Address (Choose from the map below...)" readonly />


                <label for="statusType">Status at the moment:</label>
                <select id="statusType" name="statusType">
                    <option value="0" <?php print isset($_SESSION['statusType']) && $_SESSION['statusType'] === '0' ? 'selected' : ''; ?>>Status of the facility...</option>
                    <?php

                    //print_r($statuses);
                    echo '<option value="' . $statuses[0]['statusId'] . '"' . (isset($_SESSION['statusType']) && $_SESSION['statusType'] === strval($statuses[0]['statusId']) ? 'selected' : '') . '>' . $statuses[0]['status'] . '</option>';
                    echo '<option value="' . $statuses[1]['statusId'] . '" ' . (isset($_SESSION['statusType']) && $_SESSION['statusType'] === strval($statuses[1]['statusId']) ? 'selected' : '') . '>' . $statuses[1]['status'] . '</option>';
                    unset($_SESSION['statusType']);
                    ?>

                </select>

                <input type="submit" class="submit" name="facility">
                <?php
                print isset($err['empty_input_err']) ? '<div class="invalid2">' . $err['empty_input_err'] . '</div>' : '';
                print isset($err['empty_location_err']) ? '<div class="invalid2">' . $err['empty_location_err'] . '</div>' : '';
                ?>

            </form>
        

        <!-- Map Container -->
        <div class="container-fluid d-flex">
            <!-- <div id="kontainer">
     <calcite-combobox id="categorySelect" placeholder="Filter by category" overlay-positioning="fixed" selection-mode="single">
        <calcite-combobox-item value="10000" text-label="Arts and Entertainment"></calcite-combobox-item>
        <calcite-combobox-item selected value="16000" text-label="Landmarks and Outdoors"></calcite-combobox-item>
        <calcite-combobox-item value="18000" text-label="Sports and Recreation"></calcite-combobox-item>
    </calcite-combobox>
    <div class="contents">
        <calcite-flow id="flow">
        <calcite-flow-item>
            <calcite-list id="results">
            <calcite-notice open><div slot="message">Click on the map to search for places around a location</div></calcite-notice>
            </calcite-list>
        </calcite-flow-item>
        </calcite-flow>
    </div>

     </div> -->
            <div id="map"></div>
        </div>
    </div>
    </div>
</div>

<style>
    #map {
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
        outline: none;
        font-size: 18px;
        width: 100%;
        cursor: pointer;
    }

    .collapsible-content {
        display: none;
        overflow: hidden;
        padding: 10px;
        transition: max-height 0.3s ease-out;
    }

    .collapsible-content.show {
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

<script src="js/ownermaps.js"></script>
<script>
    function checkOtherOption() {
        const facilityType = document.getElementById("facilityType").value;
        const otherFacility = document.getElementById("otherFacility");

        if (facilityType === "Other") {
            otherFacility.style.display = "block";
        } else {
            otherFacility.style.display = "none";
        }
    }
    function toggleContent(id) {
            const content = document.getElementById(id);
            content.classList.toggle("show");
        }
</script>
</body>