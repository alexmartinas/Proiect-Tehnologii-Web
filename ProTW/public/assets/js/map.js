/**
 * Created by alex on 01.06.2017.
 */
var map;
var bounds;
var marker={};

$(document).ready(function () {

    map=new google.maps.Map(document.getElementById('map'),{
        zoom: 8
    });
    geoLocationInit();
    function geoLocationInit() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }

    function createMarker(loc,i,name) {
        marker[i] = new google.maps.Marker({
            position: loc,
            icon: "../images/kid.png",
            map: map,
            title:name,
        });
    }

    function success(position) {
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;

        var myLatLng = new google.maps.LatLng(latval, lngval);

        var userMarker = new google.maps.Marker({
            position: myLatLng,
            icon: "http://maps.google.com/mapfiles/ms/micons/man.png",
            map: map,
            title: 'Your position'
        });

        bounds = new google.maps.LatLngBounds();
        bounds.extend(myLatLng);
        map.fitBounds(bounds);
        map.set('zoom',14);
        showChildrenOnMap();
        window.setInterval(function(){
            showChildrenOnMap();
        }, 50000);
    }

    function fail() {
        alert("It fails");
    }

    function showChildrenOnMap() {

        $.get('/children',function (data) {
            console.log(data);
            for(i=0;i<data[0].length;i++){
                console.log(data[0][i].location_x);
                console.log(data[0][i].location_y);
                var latval = data[0][i].location_x;
                var lngval = data[0][i].location_y;
                var loc= new google.maps.LatLng(latval,lngval);
                bounds.extend(loc);
                map.fitBounds(bounds);
                var name=data[0][i].name;
                createMarker(loc,i,name);
            }

        });

    }


});



