/**
 * Created by alex on 01.06.2017.
 */
var mapChildren;
var boundsMapChildren;
var marker={};
var userMarker;
var myLatLng;
$(document).ready(function () {


    geoLocationInit();
    watchPosition();

    function geoLocationInit() {
        mapChildren=new google.maps.Map(document.getElementById('mapChildren'),{
            zoom: 8
        });

        myLatLng = new google.maps.LatLng(46, 26);

        userMarker = new google.maps.Marker({
            position: myLatLng,
            icon: "http://maps.google.com/mapfiles/ms/micons/man.png",
            map: mapChildren,
            title: 'Your position'
        });
        boundsMapChildren = new google.maps.LatLngBounds();
        boundsMapChildren.extend(myLatLng);
        mapChildren.fitBounds(boundsMapChildren);
        mapChildren.set('zoom',14);
        showChildrenOnMap();
    }

    function watchPosition() {

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }

    function createMarker(loc,i,name) {
        marker[i] = new google.maps.Marker({
            position: loc,
            icon: "../images/kid.png",
            map: mapChildren,
            title:name
        });
    }

    function success(position) {
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;
        console.log(latval);
        console.log(lngval);
        $.post("/update/location",
            {
                location_x:latval,
                location_y:lngval
            },
            function(data,status){
                console.log(data);
            });

        myLatLng = new google.maps.LatLng(latval, lngval);
        userMarker.setPosition(myLatLng);
    }

    function fail() {
        alert("It we can not get your location");
    }

    function showChildrenOnMap() {

        $.get('/children',function (data) {
            if(data[0].length!=0)
            for(i=0;i<data[0].length;i++){
                var latval = data[0][i].location_x;
                var lngval = data[0][i].location_y;
                var loc= new google.maps.LatLng(latval,lngval);
                boundsMapChildren.extend(loc);
                mapChildren.fitBounds(boundsMapChildren);
                var name=data[0][i].name;
                createMarker(loc,i,name);
            }
            else{
                mapChildren.setCenter(userMarker.getPosition());
                mapChildren.setZoom(7);
            }

        });

    }


});



