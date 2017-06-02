/**
 * Created by alex on 01.06.2017.
 */
var map;

$(document).ready(function () {
    geoLocationInit();
    
    function geoLocationInit() {

        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(success,fail);
        }else{
            alert("Browser not supported");
        }
    }

    function  success(position) {
        console.log(position);
        var  latval=position.coords.latitude;
        var  lngval=position.coords.longitude;

        var myLatLng = new google.maps.LatLng(latval,lngval);
        createMap(myLatLng);

        var marker= new google.maps.Marker({
            position: myLatLng,
            icon: "http://maps.google.com/mapfiles/ms/micons/man.png",
            map: map,
            title: 'Your position'
        })
    }

    function fail() {
        alert("It fails");
    }


    function createMap(myLatLng){
         map = new google.maps.Map(document.getElementById('map'),{
            center: myLatLng,
            zoom: 8
        });
    }
    
    function createMarker(latlng,icn){
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: 'Hello World!'
        });

    }

    function nearbyChildren(myLatLng){


        var request = {
            location: myLatLng,
            radius: '2500',
            types: ['store']
        };

        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);

        function callback(results, status) {

            console.log(results);
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    var place = results[i];
                    latlng=place.geometry.location;
                    icn= place.icon;
                    createMarker(latlng,icn);
                }
            }
        }

    }



})
