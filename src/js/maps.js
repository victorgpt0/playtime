const categorySelect = document.getElementById("categorySelect");
  const resultPanel = document.getElementById("results");
  const flow = document.getElementById("flow");
  let infoPanel;

  const setAttribute = (heading, icon, validValue) => {
      if (validValue) {
      const element = document.createElement("calcite-block");
      element.heading = heading;
      element.description = validValue;

      const attributeIcon = document.createElement("calcite-icon");
      attributeIcon.icon = icon;
      attributeIcon.slot = "icon";
      attributeIcon.scale = "m";

      element.appendChild(attributeIcon);
      infoPanel.appendChild(element);
      }
  };

const map=L.map("map", {
    minZoom:2
  });

  const accessToken="";


  function getV2Basemap(style){
    return L.esri.Vector.vectorBasemapLayer(style,{
      token: accessToken,
      version: 2,
      places:"all"
    })
  }
  
  const basemapLayers={
    "Streets": getV2Basemap("arcgis/streets"),
    "Navigation":getV2Basemap("arcgis/navigation").addTo(map),
    "Satellite": getV2Basemap("arcgis/imagery")
  };

  L.control.layers(basemapLayers, null, {collapsed: true}).addTo(map);


  function setUserLocation(position){
    const lat = position.coords.latitude;
    const lng=position.coords.longitude;
    map.setView([lat,lng],13);
    L.marker([lat,lng])
        .addTo(map)
        .bindPopup('You are Here')
        .openPopup();
  }

  function handleLocationError(error){
    console.error("Error getting Location: ",error);
    map.setView([-1.286389, 36.817223], 13);
  }

  if("geolocation" in navigator){
    navigator.geolocation.getCurrentPosition(
      setUserLocation,
      handleLocationError,

      {
        enableHighAccuracy: true,
        timeout:5000,
        maximumAge:0
      }
    );
  }else{
    console.log("Geolocation is not supported by this browser");
    map.setView([-1.286389, 36.817223], 13);
  }

  map.zoomControl.setPosition("bottomright");

  const authentication = arcgisRest.ApiKeyManager.fromKey(accessToken);

  let activeCategory = "18000";
  let userLocation;

  const searchRadius= 5000;
  const clickedPoint= L.layerGroup().addTo(map);

  function getCurrentPosition(){
    if("geolocation" in navigator){
        navigator.geolocation.getCurrentPosition(
          (position)=>{
            userLocation=L.latLng(position.coords.latitude,position.coords.longitude);
            map.setView(userLocation, 13);

            clickedPoint.clearLayers();
            L.circle(userLocation, {
              color: "#ffff",
              stroke: true,
              weight: 2,
              opacity: 0.5,
              fill: true,
              fillOpacity: 0.25,
              fillColor: "#aaaa",
              radius: searchRadius
            }).addTo(clickedPoint);
            
            showPlaces();
          },
          (error) => {
            console.error("Error getting location:", error);
           
          }
        );
      }
    }

    getCurrentPosition();

  map.on('click', function(e){
    userLocation=e.latlng;
  

  clickedPoint.clearLayers();
  L.circle(e.latlng,{
    color:"#ffff",
    stroke: true,
    weight:2,
    opacity:0.5,
    fill:true,
    fillOpacity:0.25,
    fillColor:"#aaaa",
    radius:searchRadius

  }).addTo(clickedPoint);
  showPlaces()

})

const locationButton=L.control({position:'topleft'});
locationButton.onAdd=function(map){
  const btn = L.DomUtil.create('button','location-button');
  btn.innerHTML='📍';
  btn.style.fontSize="20px";
  btn.style.padding="5px 10px";
  btn.title="Get Current Location";
  btn.onclick=function(){
    getCurrentPosition();
  };
  return btn;
}

categorySelect.addEventListener("calciteComboboxChange", e => {
  console.log(activeCategory)
    activeCategory = categorySelect.value;
    map.closePopup();

    if(userLocation) showPlaces();

});

const layerGroup=L.layerGroup().addTo(map);

function showPlaces(){
  layerGroup.clearLayers();
  resultPanel.innerHTML="";

  if(infoPanel) infoPanel.remove();

  arcgisRest.findPlacesNearPoint({
    x: userLocation.lng,
    y: userLocation.lat,
    categoryIds: activeCategory,
    radius: searchRadius,
    authentication
  })
  .then((response)=>{
    response.results.forEach((result)=>{
      addResult(result);
    });
  });
};

function addResult(place){
  const marker = L.marker([place.location.y,place.location.x],{
    title: place.name
  }).addTo(layerGroup);
  marker.id=place.placeId;

  const infoDiv=document.createElement("calcite-list-item");
  resultPanel.appendChild(infoDiv);

  const description=`
    ${place.categories[0].label} - 
    ${Number((place.distance/1000).toFixed(1))} km
  `;

  infoDiv.label=place.name;
  infoDiv.description=description;

  infoDiv.addEventListener("click", e=>{
    map.openPopup(place.name,marker.getLatLng(),{
      offset: [0,-25]
    });
    getDetails(marker);
  })
}
function getDetails(marker){
    arcgisRest.getPlaceDetails({
      placeId: marker.id,
      requestedFields: ["all"],
      authentication
    })
    .then((result)=>{
      const placeDetails= result.placeDetails;
      map.setView(marker.getLatLng());
      infoPanel=document.createElement("calcite-flow-item");
      flow.appendChild(infoPanel)
      infoPanel.heading=placeDetails.name;
    infoPanel.description=placeDetails.categories[0].label;
    setAttribute("Description", "information", placeDetails?.description);
          setAttribute("Address", "map-pin", placeDetails?.address?.streetAddress);
          setAttribute("Phone", "mobile", placeDetails?.contactInfo?.telephone);
          setAttribute("Hours", "clock", placeDetails?.hours?.openingText);
          setAttribute("Rating", "star", placeDetails?.rating?.user);
          setAttribute("Email", "email-address", placeDetails?.contactInfo?.email);
          setAttribute("Website", "information", placeDetails?.contactInfo?.website?.split("://")[1].split("/")[0]);
          setAttribute("Facebook", "speech-bubble-social", (placeDetails?.socialMedia?.facebookId) ? `www.facebook.com/${placeDetails.socialMedia.facebookId}` : null);
          setAttribute("Twitter", "speech-bubbles", (placeDetails?.socialMedia?.twitter) ? `www.twitter.com/${placeDetails.socialMedia.twitter}` : null);
          setAttribute("Instagram", "camera", (placeDetails?.socialMedia?.instagram) ? `www.instagram.com/${placeDetails.socialMedia.instagram}` : null);

          infoPanel.addEventListener("calciteFlowItemBack", e=>{
            map.closePopup();
          })
    });

}



