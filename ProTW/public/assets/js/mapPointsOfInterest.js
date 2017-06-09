/**
 * Created by alex on 09.06.2017.
 */
/**
 * Created by alex on 01.06.2017.
 */
var map;
var bounds;
var marker=[];
var locCopil;
var copil= document.getElementsByName("idCopil")[0];
var idPoint;
var distanta;


function init(){
    map=new google.maps.Map(document.getElementById('mapPoints'),{
        zoom: 8
    });

    for(var i=0;i<marker.length;i++)
        marker[i].setMap(null);
    marker=[];

    getChildInfo();

    getChildPoints();
}

function deletePoint(id){
    idPoint=id;
    $.post("/points-of-interest/deletePoint",
        {
            id: idPoint
        },
        function(data,status){
        console.log(idPoint);
        console.log(data);
        });
    var el = document.getElementById(id);
    $(el).remove();
}

function zoom() {
    for(var i=0;i<marker.length;i++) {
        (function(){
            marker[i].addListener( 'click', listener.bind( null, i));
        }())
    }

    function listener(index) {
        map.setCenter(new google.maps.LatLng(marker[index]['position'].lat(), marker[index]['position'].lng()));
        map.setZoom(17);
    }

}

function getChildPoints() {

    $.get('/points-of-interest/getPoints',{
        id:copil.id
    },function (data) {
        $.each(data, function(index, value){

            $.each(value, function(index, valoare){
                var latval = valoare['location_x'];
                var lngval = valoare['location_y'];
                var loc= new google.maps.LatLng(latval,lngval);
                bounds.extend(loc);
                map.fitBounds(bounds);
                var name=valoare['name'];
                createMarker(loc,name);
            })
        })
        zoom();
    });

}

function getChildInfo(){
    $.get('/monitor-children/childInfo',{
        id:copil.id
    },function (data) {
        var latval = data['location_x'];
        var lngval = data['location_y'];
        locCopil= new google.maps.LatLng(latval,lngval);
        marker.push( new google.maps.Marker({
            position: locCopil,
            icon: "../images/kid.png",
            map: map,
            title:data['name']
        }));

        bounds = new google.maps.LatLngBounds();
        bounds.extend(locCopil);
        map.fitBounds(bounds);
        map.set('zoom',14);
    });
}

function createMarker(loc,name) {
    marker.push(new google.maps.Marker({
        position: loc,
        icon: "http://maps.google.com/mapfiles/ms/micons/red.png",
        map: map,
        title:name
    }));
}

$(document).ready(function () {

    init();


});
