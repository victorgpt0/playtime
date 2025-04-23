const accessToken = "";

const map = L.map("map", {
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
        map.setView([34.101, -1.339], 13); // Example coordinates
      }
    );
  } else {
    // Fallback if geolocation is not supported
    map.setView([34.101, -1.339], 13); // Default coordinates
  }
}

// Call function to get user location
getCurrentPosition();

function markLocations(userLocations){
// const userLocation = [
//  { lat: -1.2921, lng: 36.8219, name: "Facility A" }, // Example data
//  { lat: -1.2931, lng: 36.8229, name: "Facility B" }
// ];
//console.log("Locations received:", userLocations);

// Add markers for user-specific locations with a different color
userLocations.forEach(loc => {
  const userMarker = L.marker([loc.lat, loc.lng], {
    icon: L.icon({
      iconUrl: '../assets/icons/push-pin.png',
      iconSize: [25, 25],
      iconAnchor: [12, 41]
    })
  }).addTo(map);

  userMarker.bindPopup(`<b>${loc.facilityName}</b><br><br><b>${loc.name}</b><p>${loc.lat}, ${loc.lng}</p>`);
});
}
