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
$err = $ObjGlobal->getMsg('f_error');
$editerr = $ObjGlobal->getMsg('f_editerror');
?>


<div class="container" id="main-content">
    <h1>My Facilities</h1>
    <div class="container-fluid mb-5">
        <div id="previous" class="d-flex">
            <?php
            if(isset($_SESSION['user'])){
            $userLocations = [];
            foreach ($facilityCard as $card) {
                $userLocations[] = [
                    'lat' => floatval($card['latitude']),
                    'lng' => floatval($card['longitude']),
                    'name' => $card['place_id'],
                    'facilityName'=>$card['name']
                ];
            ?>
                <div class="card" style="width: 18rem">
                    <img src="../../assets/images/GrassBackground3.jpg" class="card-img-top" alt="">
                    <?php
                    if (strval($card['statusId']) === AVAILABLE):
                    ?>
                        <div class="available">
                            Available
                        </div>
                    <?php
                    elseif (strval($card['statusId']) === UNAVAILABLE):
                    ?>
                        <div class="unavailable">
                            Unavailable
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5><?= print $card['name']; ?></h5>
                        <p class="card-text"><?= $card['description'] ?></p>
                        <p class="card-text"><?= $card['place_id'] ?></p>
                        <p class="card-text"><b><?= $card['price_per_hour'] ?></b></p>
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn btn-primary" data-card='<?php echo json_encode($card, JSON_HEX_APOS | JSON_HEX_QUOT); ?>' onclick="edit(this)">Edit</a>
                            </div>
                            <div class="col">
                                <form action="<?php print basename($_SERVER['PHP_SELF']);?>" method="post">
                                <input type="hidden" name="itemId" value=<?=$card['facilityId'];?>>
                                                                <button type="submit" name="deleteFacility" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this Facility?\nThis action cannot be undone!');">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
            ?>
            <script>
                const userLocations = <?= json_encode($userLocations); ?>;
                console.log(userLocations);
            </script>

        </div>
    </div>




    <div class="edit-content" id="editContent">
        <button class="collapsible-btn">
            <h2>Edit Sports Facility</h2>
        </button>
        <div class="form-section">
            <form action="<?php print basename($_SERVER['PHP_SELF']); ?>" method="post" id="editFacilityForm">
                <label for="facilityEditName">Facility Name:</label>
                <input type="text" id="facilityEditName" name="facilityEditName" placeholder="Madaraka Football Arena#1" value="<?php print isset($_SESSION['facilityEditName']) ? $_SESSION['facilityEditName'] : '';
                                                                                                                                unset($_SESSION['facilityEditName']); ?>">

                <label for="facilityEditType">Facility Type:</label>
                <select id="facilityEditType" name="facilityEditType" onchange="checkOtherOption()">
                    <option value="0" <?php print isset($_SESSION['facilityEditType']) && $_SESSION['facilityEditType'] === '0' ? 'selected' : ''; ?>>Select a Pitch...</option>
                    <?php
                    // print_r($facilityType);
                    foreach ($facilityType as $row) {
                        echo '<option value="' . $row['typeId'] . '" ' . (isset($_SESSION['facilityEditType']) && $_SESSION['facilityEditType'] === strval($row['typeId']) ? 'selected' : '') . '>' . $row['type'] . '</option>';
                    }
                    ?>
                    <option value="Other" <?php print isset($_SESSION['facilityEditType']) && $_SESSION['facilityEditType'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>

                <div id="otherFacility" style="display: <?php echo (isset($_SESSION['facilityEditType']) && $_SESSION['facilityEditType'] === 'Other') ? 'block' : 'none';
                                                        unset($_SESSION['facilityEditType']); ?>;">
                    <label for="otherFacilityEditType"><b>Please specify</b></label>
                    <input type="text" id="otherFacilityEditType" name="otherFacilityEditType" value="<?php print isset($_SESSION['otherFacilityEditType']) ? $_SESSION['otherFacilityEditType'] : '';
                                                                                                        unset($_SESSION['otherFacilityEditType']); ?>">
                </div>

                <label for="editDescription">Description</label>
                <input type="textarea" id="editDescription" name="editDescription" placeholder="7-a-side Football Turf" value="<?php print isset($_SESSION['editDescription']) ? $_SESSION['editDescription'] : '';
                                                                                                                                unset($_SESSION['editDescription']); ?>">

                <label for="facilityEditPrice">Price per Hour:</label>
                <input type="number" id="facilityEditPrice" name="facilityEditPrice" placeholder="1500" value="<?php print isset($_SESSION['facilityEditPrice']) ? $_SESSION['facilityEditPrice'] : '';


                                                                                                                unset($_SESSION['facilityEditPrice']); ?>">

                <label for="statusEditType">Status at the moment:</label>
                <select id="statusEditType" name="statusEditType">
                    <option value="0" <?php print isset($_SESSION['statusEditType']) && $_SESSION['statusEditType'] === '0' ? 'selected' : ''; ?>>Status of the facility...</option>
                    <?php

                    //print_r($statuses);
                    echo '<option value="' . $statuses[0]['statusId'] . '"' . (isset($_SESSION['statusEditType']) && $_SESSION['statusEditType'] === strval($statuses[0]['statusId']) ? 'selected' : '') . '>' . $statuses[0]['status'] . '</option>';
                    echo '<option value="' . $statuses[1]['statusId'] . '" ' . (isset($_SESSION['statusEditType']) && $_SESSION['statusEditType'] === strval($statuses[1]['statusId']) ? 'selected' : '') . '>' . $statuses[1]['status'] . '</option>';
                    unset($_SESSION['statusEditType']);
                    ?>

                </select>
                <input type="hidden" id="facilityEditID" name="facilityEditID" value="<?php print isset($_SESSION['facilityEditID']) ? $_SESSION['facilityEditID'] : '';
                                                                                        unset($_SESSION['facilityEditID']); ?>">



                <input type="submit" class="submit" name="editFacility">
                <?php
                print isset($editerr['empty_input_err']) ? '<div class="invalid2">' . $editerr['empty_input_err'] . '</div>' : '';
                print isset($editerr['empty_location_err']) ? '<div class="invalid2">' . $editerr['empty_location_err'] . '</div>' : '';
                ?>

            </form>

        </div>

    </div>



    <button class="collapsible-btn" onclick="toggleContent('formContent')">
        <h2>Add New Sports Facility</h2>
        <h5>(Click to Show)</h5>
    </button>
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

                <input type="hidden" id="facilityLat" name="latitude" placeholder="Latitude" value="<?php print isset($_SESSION['latitude']) ? $_SESSION['latitude'] : '';
                                                                                                    unset($_SESSION['latitude']); ?>" readonly />
                <input type="hidden" id="facilityLng" name="longitude" placeholder="Longitude" value="<?php print isset($_SESSION['longitude']) ? $_SESSION['longitude'] : '';
                                                                                                        unset($_SESSION['longitude']); ?>" readonly />
                <input type="text" id="facilityAddress" name="address" value="<?php print isset($_SESSION['address']) ? $_SESSION['address'] : '';
                                                                                unset($_SESSION['address']); ?>" placeholder="Address (Choose from the map below...)" readonly />




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
        border-radius: 10px;
        outline: none;
        font-size: 18px;
        width: 100%;
        cursor: pointer;
    }

    .collapsible-content.show {
        display: block;
    }

    .collapsible-content {
        display: none;
        overflow: hidden;
        padding: 10px;
        transition: max-height 0.3s ease-out;
    }

    .edit-content {
        display: none;
        overflow: hidden;
        padding: 10px;
        transition: max-height 0.3s ease-out;
    }

    .edit-content.show {
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
        if (id === 'formContent' && content.classList.contains('show')) {
        // Small delay to ensure the container is fully visible
        setTimeout(() => {
            if (map) {  // Assuming your map instance is stored in window.map
                map.invalidateSize();
            }
        }, 100);
    }
    }

    function edit(element) {
        const card = JSON.parse(element.getAttribute('data-card'));

        document.getElementById("facilityEditID").value = card.facilityId;
        document.getElementById("facilityEditName").value = card.name;
        document.getElementById("editDescription").value = card.description;
        //document.getElementById("facilityLat").value = card.latitude;
        // document.getElementById("facilityLng").value = card.longitude;
        // document.getElementById("facilityAddress").value = card.place_id;
        document.getElementById("facilityEditPrice").value = card.price_per_hour;
        document.getElementById("statusEditType").value = card.statusId;
        document.getElementById("facilityEditType").value = card.typeId;


        const content = document.getElementById("editContent");
        content.classList.toggle("show");

    }
    markLocations(userLocations);

    function deleteFacility(element, facilityId){
        console.log(facilityId);
        const isConfirmed=confirm("Are you sure you want to remove this Facility?\nThis action cannot be undone!");
        if(isConfirmed){
            const formData=new FormData();
            formData.append('DfacilityId',facilityId);

            fetch("owner.php",{
                method: 'post',
                body: formData
            })
            .then(response=>response.json())
            .catch(error=>console.error("Error:",error));
        }



    }
</script>
</body>