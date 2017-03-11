function initMap() {
	var myLatLng = {lat: 58.3782485, lng: 26.7146733}
	var mapOptions1 = {
		center: new google.maps.LatLng(myLatLng),
		zoom:17,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var mapOptions2 = {
		center: new google.maps.LatLng(myLatLng),
		zoom:3,
		mapTypeId: google.maps.MapTypeId.HYBRID
	};
	var map1 = new google.maps.Map(document.getElementById("googleMap1"),mapOptions1);
	var map2 = new google.maps.Map(document.getElementById("googleMap2"),mapOptions2);
	
	marker1 = new google.maps.Marker({
		position: myLatLng,
		map: map1,
		title: 'Pollerina HQ'
	});
	infowindow1 = new google.maps.InfoWindow({
		content: "Pollerina HQ"
	});
	infowindow1.open(map1, marker1);

	marker2 = new google.maps.Marker({
		position: myLatLng,
		map: map2,
		title: 'Pollerina HQ'
	});
	infowindow2 = new google.maps.InfoWindow({
		content: "Pollerina HQ"
	});
	infowindow2.open(map2, marker2);
}