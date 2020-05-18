

<!doctype html>
 <body style='background-color:powderblue'>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>Distance from  BYOs - 1km 2km Maps </title>
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Primary School Maps">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="image/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="favicon.ico">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified materialize.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>

#map_canvas {
	width: 130vmin; 
	height: 90vmin; 
	margin-left: auto; 
	margin-right: auto;
	}

	h1 {
	  font-size: 22px;
	  font-weight: bold;
	}
	h2{
	  font-size: 18px;
	  font-weight: bold;
	}
	h3 {
	  font-size: 15px;
	  font-weight: bold;
	}

.demo-card-square.mdl-card {
  margin-top: 10px;
  width: 100%;
  min-height: 0;
  background-color: #F8F8F8;
}

.mdl-card__media {
    margin: 0;
    background-color: #FFFFFF;
}

.demo-avatar {
        width: 36px;
        height: 36px;
        border-radius: 18px;
        vertical-align: middle;
        margin: 10px;
      }
.header {
  padding: 20px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 30px;
}

</style>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

  <style>
  .leaflet-container {
    touch-action: none;
  }
  </style>
 
  </head>
  <body>
   <input type="button" onclick="window.location.href = '/daobaoright.atspace.cc/search.php';" value="Search Vendors"/>

<script>
jQuery(document).ready(function() {

              
		if (typeof initialize == 'function') {		
		initialize();
		}

});


</script> 
 

 

  

 
  <main>

      <div id="fb-root" style="padding-top:5px"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=204382791059";
        fjs.parentNode.insertBefore(js, fjs);

      }(document, 'script', 'facebook-jssdk'));
      </script>	

    <div class="row">
      <div class="col s12 l8">
        <div style="padding-top: 10px;" class="fb-like" data-send="true" data-layout="button_count" data-width="160" data-show-faces="true" ></div>

        

<SCRIPT type=text/javascript>
 
	var map, markers;
        var vendorList="";

	function getLocation() {
	// Get location no more than 5 minutes old. 300000 ms = 5 minutes.
	navigator.geolocation.getCurrentPosition(showLocation, showError, {enableHighAccuracy:true,maximumAge:300000});
	}
	
	function showError(error) {
	document.getElementById('near').innerHTML = error.message + " : Please enter Postal Code";
	document.getElementById('map_canvas').style.display = 'none';
//	alert(error.code + ' ' + error.message);
	}
		
	function initialize() { 
	document.getElementById('near').innerHTML = "Please enter Postal Code or use GPS";
	// document.getElementById('map_canvas').style.display = 'block';	
	var OScalc = (navigator.appVersion.indexOf("Mac")!=-1 &&  $('#adcol').css('display')=='block');

	map = L.map('map_canvas',{ touchZoom: true });
	markers = new L.LayerGroup().addTo(map);
	if (OScalc) {
		$("#map_canvas").css("width", "50vmin");
		$("#map_canvas").css("height", "50vmin");
	}
	}

	function getgps() { 
	if (navigator.geolocation) {
		getLocation();
		} else 
		{
		document.getElementById('near').innerHTML = "Please enter Postal Code";
		document.getElementById('map_canvas').style.display = 'none';		
		} 
	}	
	
	function showMap(data)
	{
	document.getElementById('map_canvas').style.display = 'block';
	// draw onemap	

   	map.setView([data.lat, data.lng], 14);

	var basemap = L.tileLayer('https://maps-{s}.onemap.sg/v3/Default/{z}/{x}/{y}.png', {
		detectRetina: true,
		maxZoom: 19,
		minZoom: 11
	});

	basemap.addTo(map);

	markers.clearLayers();

	var infoIcon = L.icon({
        iconUrl: 'images/cLoc.png',
        iconSize: [32, 37],
        iconAnchor: [16, 37]
    });

	var marker = new L.Marker([parseFloat(data.lat), parseFloat(data.lng)], {icon: infoIcon}).addTo(markers);


         //load the map with data
	setMarkers(map, data);

	var circle1km = L.circle([data.lat, data.lng], {
	color: 'blue',
	fillColor: 'blue',
	fillOpacity: 0.1,
	weight: 1,
	radius: 1000
	}).addTo(markers);

	var circle2km = L.circle([data.lat, data.lng], {
	color: 'red',
	fillColor: 'red',
	fillOpacity: 0.1,
	weight: 1,    
	radius: 2000
	}).addTo(markers);

	// TODO codeLatLng(latlng);
		
	}

	function showLocation(position) {
	var latlng = {lat:position.coords.latitude,lng: position.coords.longitude};
 
	// TODO codeLatLng(latlng);
	document.getElementById('near').innerHTML = 'GPS Location';
	showMap(latlng);
	}

	function setMarkers(map, latlng) {
	// Add markers to the map
              
                  var cs = document.getElementById("cuisine").value;

         //  alert( latlng.lat +"  "+latlng.lng); 
	var jqxhr = $.post("getByo2.php", { lat:latlng.lat, lng:latlng.lng, cuisine:cs }, 
		function(data){
		var markers = data.marker;
               
               createVendorList("<table border=1>");
               createVendorList("<th>  Name  </th> <th > Distance </th> <th> URL </th> <th> Discount </th><th> Direction </th>");
                  // alert(data.result);
		if (!(data.result=="OK"))
               
			alert(data.result);
			else
			{
			$.each(markers, function(i, value) { 
				var label = markers[i].name;
				var dist = markers[i].dist;
                                var lat =  markers[i].lat;
                                var lng = markers[i].lng;
                                var discount = markers[i].discount;
                                
                                 
				var html = "<A href='" + markers[i].URL + "' target='_blank'>" + label + "</A><BR />"+ dist + " km";
				
                                
                                var vl = "<tr><td>"+ label +"</td><td>"+dist+"km </td><td>"+"<A href='" + markers[i].URL + "' target='_blank'>" + label + "</A><BR />"  +"</td><td>" + discount + "</td><td> <a href= 'http://maps.google.com/maps?q="+lat+","+lng  +"' target='_blank'> Get There </a></td></tr>"
                                createVendorList(vl);

				createMarker(map,markers[i],label,html);
				});
			}
		}, "json");
		jqxhr.fail(function(request, status, err) {
		alert("AAA" + status); 
		});	



	}

        function createVendorList(html)
        {
              vendorList = vendorList + html;
		 
            document.getElementById('vendorList').innerHTML =vendorList;
      

        }


	

	// A function to create the marker and set up the event window
	function createMarker(map,point,label,html) {
	var myIcon = L.icon({
        iconUrl: 'images/byo.png',
        iconSize: [32, 37],
        iconAnchor: [16, 37],
        popupAnchor: [0, -37]
    });
	var marker = new L.Marker([parseFloat(point.lat), parseFloat(point.lng)], {icon: myIcon}).addTo(markers);
    marker.bindPopup(html);
	}

	function showAddress() {

           //#1
	var address = document.getElementById("address").value;
        var cuisine = document.getElementById("cuisine").value;
        
        vendorList="";
        
        //alert(cuisine)
        
        
        
	if (address =='') {
		document.getElementById('near').innerHTML = 'Please enter Postal Code'; 
		return;
	}

	var jqxhr = $.get("https://developers.onemap.sg/commonapi/search", { searchVal:address, returnGeom:"Y", getAddrDetails:"Y" }, 
		function(data){
		if (data.found==0)
			{
			document.getElementById('near').innerHTML = 'no result found';
			}
			else
			{
			var foundAddress = data.results[0].ADDRESS;
			var latlng = {lat:data.results[0].LATITUDE ,lng:data.results[0].LONGTITUDE};
                        var cuisine = cuisine;
			document.getElementById('near').innerHTML = foundAddress;
			showMap(latlng);
			}
		}, "json");
		jqxhr.fail(function(request, status, err) {
		document.getElementById('near').innerHTML = 'Postal Code error'; 
		});	
	}
	
	function codeLatLng(latlng) {
	}

</script>

<div class =header>
<H1>Find BYOs within 1 and 2 km</H1>
</div>
<div id="map_canvas" style="display:none;"> </div>


<div class="row">
	<div class="center-align" id='near'></div>
  
	<div class="col s3">
	<button class = "btn-floating btn-large waves-effect waves-light grey right" onclick="getgps()">
		<i class = "material-icons">gps_fixed</i></button>
		</div>
	<div class="input-field col s6">
	  <input type="text" id="address"/>
     
	</div>
        
        <div class="input-field col s4" style="width:300px">
             <select id= "cuisine" class="browser-default waves-effect waves-light">
      
      <option value="all">No preference</option>
      <option value="Western">Western</option>
      <option value="All-Day Breakfast">All-Day Breakfast</option>
      <option value="Australian">Australian</option>
      <option value="Beverage">Beverage</option>
      <option value="Local">Local</option>
      <option value="Chinese">Chinese</option>
      <option value="Italian">Italian</option>
 
      
      
    </select>
    <label> Select Cuisine</label>
	 
       </div> 
         
 
        
        <div class="col s3">
	<button class = "btn-floating btn-large waves-effect waves-light grey" onclick="showAddress()">
		<i class = "material-icons">search</i></button>
	</div>
        
        
        
</div>

<P>Get your <b>Home</b> position by


 
</select>
	 
 


<UL style="list-style-type:none">
<LI><i class = "material-icons">gps_fixed</i> Current Location</LI>
<LI><i class = "material-icons">search</i> Postal Code</LI>
</UL>

<table border=1>

 
      <div class="center-align" id='vendorList'></div>
    
      
</table>      
</P>
 

 




      </div>
 
    </div>
 

  
 
  </main>



     

      
  </body>
  
  <!-- https://jsfiddle.net/007zkvut/9/  -->
</html>
