const accessToken = "AAPTxy8BH1VEsoebNVZXo8HurFS7LISrPsZH3DuNlMdWT5xPsVsoHg3YKlpvK6VFP2OaO4ckEkoVxT88VQrbgw7CJ1M-l-1UL7_zOQ3vIgSmOwONl5mn8Wbvz7Ne39p2k57rzkfpfEPduky7hTHxFscAwZYH9BjhrUN4d9tf0wTP3hZn8JAJKnta19N4u21nOD3Ghje4AsDHRlNPUTQMqFIRUOM7QLr-qDzi6Srn3tlW4Fw.AT1_byREAv5a";

const map = L.map("map2", {
  minZoom: 2,
  zoomControl: false // Disable default zoom control to customize its position
});

// Move zoom control to bottom right
L.control.zoom({ position: 'bottomright' }).addTo(map);

function getV2Basemap(style) {
  return L.esri.Vector.vectorBasemapLayer(style, {
    token: accessToken,
    version: 2,
    places: "all"
  });
}

const basemapLayers = {
  "Streets": getV2Basemap("arcgis/streets"),
  "Navigation": getV2Basemap("arcgis/navigation").addTo(map),
  "Satellite": getV2Basemap("arcgis/imagery")
};

// Layer control for basemaps
L.control.layers(basemapLayers, null, { collapsed: true }).addTo(map);

let userLocation;
function getCurrentPosition() {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        // Set map view to user's current location on first load
        userLocation = L.latLng(position.coords.latitude, position.coords.longitude);
        map.setView(userLocation, 13); // Center map on user's location with zoom level 13

        // Add a search control to search for places
        const searchControl = L.esri.Geocoding.geosearch({
          position: "topleft",
          placeholder: "Enter an address or place",
          useMapBounds: true,
          providers: [
            L.esri.Geocoding.arcgisOnlineProvider({
              apikey: accessToken
            })
          ]
        }).addTo(map);

        // Layer group for search results
        const results = L.layerGroup().addTo(map);

        // On search result, display and bind marker popup
        searchControl.on("results", (data) => {
          results.clearLayers();
          for (let i = data.results.length - 1; i >= 0; i--) {
            const marker = L.marker(data.results[i].latlng);

            const lngLatString = `${Math.round(data.results[i].latlng.lng * 100000) / 100000}, ${Math.round(data.results[i].latlng.lat * 100000) / 100000}`;
            marker.bindPopup(`<b>${lngLatString}</b><p>${data.results[i].properties.LongLabel}</p>`).openPopup();

            // Add event to update form fields on marker click
            marker.on("click", () => {
              document.getElementById("facilityLat").value = data.results[i].latlng.lat;
              document.getElementById("facilityLng").value = data.results[i].latlng.lng;
              document.getElementById("facilityAddress").value = data.results[i].properties.LongLabel;
            });

            results.addLayer(marker);
          }
        });
      },
      (error) => {
        console.error("Error getting location:", error);
        // If location access is denied, set a default view
        map.setView([34.101, -118.339], 13); // Example coordinates
      }
    );
  } else {
    // Fallback if geolocation is not supported
    map.setView([34.101, -118.339], 13); // Default coordinates
  }
}

// Call function to get user location
getCurrentPosition();

function markLocations(userLocations) {
  // Add selected locations from the database (assumes `userLocations` array with each location having `lat`, `lng`)
  // This should be populated dynamically from your backend database
  // const userLocations = [
  //   { lat: -1.2921, lng: 36.8219, name: "Facility A" }, // Example data
  //   { lat: -1.2931, lng: 36.8229, name: "Facility B" }
  // ];

  // Add markers for user-specific locations with a different color
  userLocations.forEach(loc => {
    const userMarker = L.marker([loc.lat, loc.lng], {
      icon: L.icon({
        iconUrl: '../assets/icons/push-pin.png',
        iconSize: [25, 25],
        iconAnchor: [12, 41]
      })
    }).addTo(map);

    userMarker.bindPopup(`
      <div class="card" style="width: 18rem">
      <div class="card-body">
      <p class="card-text"><b>${loc.facilityName}</b></p>
      <p class="card-text">${loc.type}</p>
      <p class="card-text"><b>${loc.name}</b></p>
      <p class="card-text"><b>KES ${loc.price}</b> per Hour</p>
      <div class="d-flex justify-content-between">
      <button class="btn btn-primary" type="button" onclick="window.location.href='booking.php?facilityName=${encodeURIComponent(loc.facilityId)}'">Book Now</button>
      <button class="btn" type="button" id="favouriteButton" onclick="toggleFavourite();"><img id="favouriteImg" src="../../assets/icons/heart.png" alt="Add to Favourites" style="width: 20px;"></button>
      </div>
      </div>
      </div>
      `);
  });
}

function initMap() {
  if (id === 'map2' && content.classList.contains('show')) {
    // Small delay to ensure the container is fully visible
    setTimeout(() => {
      if (window.map) {  // Assuming your map instance is stored in window.map
        window.map.invalidateSize();
      }
    }, 100);
  }
}
