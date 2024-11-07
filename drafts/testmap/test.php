<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Collapsible Form and Map</title>
<style>
    /* Basic styling for the form container */
    .collapsible-container {
        width: 80%;
        margin: 0 auto;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Collapsible button */
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

    /* Collapsible content */
    .collapsible-content {
        display: none;
        overflow: hidden;
        padding: 10px;
        transition: max-height 0.3s ease-out;
    }

    /* Show content when expanded */
    .collapsible-content.show {
        display: block;
    }

    /* Map placeholder styling */
    .map-container {
        height: 300px;
        background-color: #e0e0e0;
        text-align: center;
        line-height: 300px;
        font-size: 18px;
        color: #555;
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>
</head>
<body>

<div class="collapsible-container">
    <button class="collapsible-btn" onclick="toggleContent('formContent')">Add New Sports Facility (Click to Expand)</button>
    <div class="collapsible-content" id="formContent">
        <form>
            <label for="facilityName">Facility Name:</label>
            <input type="text" id="facilityName" name="facilityName" placeholder="Madaraka Football Arena#1"><br><br>

            <label for="facilityType">Facility Type:</label>
            <select id="facilityType" name="facilityType">
                <option value="0">Select a Pitch...</option>
                <!-- Add other options here -->
            </select><br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" placeholder="7-a-side Football Turf"><br><br>

            <label for="pricePerHour">Price per Hour:</label>
            <input type="text" id="pricePerHour" name="pricePerHour" placeholder="1500"><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Address (Choose from the map below...)"><br><br>

            <label for="status">Status at the moment:</label>
            <select id="status" name="status">
                <option value="0">Status of the facility...</option>
                <!-- Add other options here -->
            </select><br><br>

            <input type="submit" value="Submit">
        </form>
    

    
        <div class="map-container">
            <!-- Placeholder for the map -->
            Map will appear here
        </div>
    </div>
    </div>
</div>

<script>
    function toggleContent(id) {
        const content = document.getElementById(id);
        content.classList.toggle("show");
    }
</script>

</body>
</html>
