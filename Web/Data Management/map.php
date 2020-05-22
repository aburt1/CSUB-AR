<!DOCTYPE html>
<html>

<head>
	<title>CSUB AR - 2D Map</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<style>
#refreshButton {
  position: absolute;
  top: 20px;
  right: 20px;
  padding: 10px;
  z-index: 400;
}
@import url('https://fonts.googleapis.com/css?family=PT+Sans');
.btn {
  display: inline-block;
  background: transparent;
  text-transform: uppercase;
  font-weight: 500;
  font-style: normal;
  font-size: 0.625rem;
  letter-spacing: 0.3em;
  color: rgba(223,190,106,0.7);
  border-radius: 0;
  padding: 18px 80px 20px;
  transition: all 0.7s ease-out;
  background-image: linear-gradient(to right, #2b5876 0%, #4e4376 51%, #2b5876 100%);

  background-position: 1% 50%;
  background-size: 300% 300%;
  text-decoration: none;
  margin: 0.625rem;
  border: none;
  border: 1px solid rgba(223,190,106,0.3);
}

.btn:hover {
  color: #fff;
  border: 1px solid rgba(223,190,106,0);
  color: #fff;
  background-position: right center;
}

</style>
<body>

	<div id="mapid" style="position:fixed;width:100%;height:100%;"></div>
	<body>
	  <div id="map"></div>
	  <button class="btn" id="refreshButton" href="https://bigpapaburt.com/data/data.php">Admin</button>
	  <!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
		  Launch demo modal
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			</div>
		  </div>
		</div>
	</body>
	<script>
		var client = new XMLHttpRequest();
		client.open('GET', 'data.json'); //Get json file 
		client.onreadystatechange = function() {
			localStorage.setItem("arrString", client.responseText); // save response to localStorage
		}
		client.send();
		var arrString = localStorage.getItem("arrString"); // get json from localStorage to string
		var locations = eval('(' + arrString + ')'); // parse string to array

		var mymap = L.map('mapid', {
			maxZoom: 21,
			minZoom: 17,
			maxBounds: [
				//south west
				[35.339547, -119.114692],
				//north east
				[35.354634, -119.091368]
			],
		}).setView([35.349208, -119.102976], 17);

		L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
			maxZoom: 21,
			minZoom: 17,
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
				'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			id: 'mapbox.streets'
		}).addTo(mymap);

		var yellowIcon = L.icon({
			iconUrl: 'yellow.png',
			iconSize: [20, 20], // size of the icon
			iconAnchor: [10, 10], // point of the icon which will correspond to marker's location
			popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
		});

		//Loop through the markers array
		for (var i = 0; i < locations.length; i++) {

			var lon = locations[i]["longitude"];
			var lat = locations[i]["latitude"];
			var popupText = locations[i]["name"];

			var markerLocation = new L.LatLng(lat, lon);
			var marker = new L.Marker(markerLocation);
			mymap.addLayer(marker);

			marker.bindPopup(popupText);

		}

		var popup = L.popup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(mymap);
		}

		mymap.on('click', onMapClick);
	</script>
</body>

</html>