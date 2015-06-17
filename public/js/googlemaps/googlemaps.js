/**
 * Created on 17.04.15.
 */
$(document).ready(function(){
    //google maps namespace
    var googleMaps = {
        displayStreetView : function() {
            var latlng = new google.maps.LatLng(48.2719865,25.94633239999996);
            var mapOptions = {
                zoom: 18,
                center: latlng
            };
            var gpsInformation = $(".detail").data("gps");
            if (gpsInformation != "") {
                var lat = gpsInformation.split(",")[0];
                var lng = gpsInformation.split(",")[1];

                var panorama = new  google.maps.StreetViewPanorama(document.getElementById("pano"), {
                    position: new google.maps.LatLng(lat,lng),
                    visible: true
                });
                var map = new google.maps.Map(document.getElementById("map_canvas"), {
                    center: new google.maps.LatLng(lat,lng),
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    streetViewControl: true,
                    streetView: panorama
                });

                google.maps.event.addListener(panorama, "position_changed", function() {
                    map.setCenter(panorama.getPosition());
                });
            }
            else
            {
                geocoder = new google.maps.Geocoder();
                var address = $(".detail").data("address");
                map = new google.maps.Map($("#map_canvas")[0], mapOptions);
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var panorama = new  google.maps.StreetViewPanorama(document.getElementById("pano"), {
                            position: new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng()),
                            visible: true
                        });
                        var map = new google.maps.Map(document.getElementById("map_canvas"), {
                            center: new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng()),
                            zoom: 14,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            streetViewControl: true,
                            streetView: panorama
                        });

                        google.maps.event.addListener(panorama, "position_changed", function() {
                            map.setCenter(panorama.getPosition());
                        });
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }
        },
        displayLocation : function() {
            var geocoder;
            var map;
            var latlng = new google.maps.LatLng(48.2719865,25.94633239999996);
            var mapOptions = {
                zoom: 18,
                center: latlng
            };
            var gpsInformation = $(".detail").data("gps");
            if (gpsInformation != "") {
                var lat = gpsInformation.split(",")[0];
                var lng = gpsInformation.split(",")[1];
                latlng = new google.maps.LatLng(lat,lng);
                var mapOptions = {
                    zoom: 18,
                    center: latlng
                };
                map = new google.maps.Map($("#map-canvas")[0], mapOptions);
                var address = $(".detail").data("address");
                var title = $(".media-heading").html();
                var contentString = "<div><b>" +
                    title +
                    "</b><span>" +
                    address +
                    "</span></div>";

                var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    pixelOffset: new google.maps.Size(0,35)
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: latlng
                });
                infowindow.open(map,marker);
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

            } else
            // try geocoding, gps is empty
            {
                geocoder = new google.maps.Geocoder();
                var address = $(".detail").data("address");
                map = new google.maps.Map($("#map-canvas")[0], mapOptions);
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }
        },
        selectGeoLocation : function() {
            var markers = [];
            var map = new google.maps.Map(document.getElementById('map-canvas-add'), {
                zoom:15,
                maxZoom: 19,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var defaultMarker;
            var gpsElement = $("#gps");
            if (gpsElement.val() != "") {
                var lat = gpsElement.val().split(",")[0];
                var lng = gpsElement.val().split(",")[1];
                var myLatlng = new google.maps.LatLng(lat,lng);
                defaultMarker = new google.maps.Marker({
                    position: myLatlng,
                    map: map
                });
                map.setCenter(myLatlng);
            } else {
                var defaultBounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(48.2719865,25.94633239999996),
                        new google.maps.LatLng(48.2736678,25.94753239999996));
                map.fitBounds(defaultBounds);
            }

            // Create the search box and link it to the UI element.
            var input = /** @type {HTMLInputElement} */(
                document.getElementById('pac-input'));
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            google.maps.event.addListener(map, 'click', function(event) {
                if (defaultMarker) {
                    defaultMarker.setMap(null);
                }
                for (var i = 0, marker; marker = markers[i]; i++) {
                    marker.setMap(null);
                }
                var marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
                $("#gps").val(marker.getPosition().lat()+","+marker.getPosition().lng());

                markers.push(marker);
            });

            var searchBox = new google.maps.places.SearchBox(
                /** @type {HTMLInputElement} */(input));

            // Listen for the event fired when the user selects an item from the
            // pick list. Retrieve the matching places for that item.
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                if (defaultMarker) {
                    defaultMarker.setMap(null);
                }
                for (var i = 0, marker; marker = markers[i]; i++) {
                    marker.setMap(null);
                }

                // For each place, get the icon, place name, and location.
                markers = [];
                var bounds = new google.maps.LatLngBounds();
                // clear all markers
              //  map.clearOverlays();
                for (var i = 0, place; place = places[i]; i++) {
                    var image = {
                        url: place.icon,
                        size: new google.maps.Size(70, 70),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(37, 34),
                        scaledSize: new google.maps.Size(38, 38)
                    };

                    // Create a marker for each place.
                    var marker = new google.maps.Marker({
                        map: map,
                      //  icon: image,
                        title: place.name,
                        position: place.geometry.location
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        $("#gps").val(marker.getPosition().lat()+","+marker.getPosition().lng());
                    });

                    markers.push(marker);

                    bounds.extend(place.geometry.location);
                }

                    map.fitBounds(bounds);
            });
        }
    };
    if (typeof (google) != 'undefined') {
    if ($("#map-canvas-add").length > 0) {
        googleMaps.selectGeoLocation();
    } else if ($("#pano").length > 0) {
        googleMaps.displayStreetView();
    } else {
        // details page
        googleMaps.displayLocation();
    }
    }

});
