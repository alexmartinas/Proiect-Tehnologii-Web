/**
 * Created by alex on 09.06.2017.
 */
/**
 * Created by alex on 01.06.2017.
 */
var map;
var bounds;
var marker=[];
var fences=[];
var inout=[];
var locCopil;
var copil= document.getElementsByName("idCopil")[0];
var idPoint;
var distanta;


function monitor(){
    var poz;
    var latcopil;
    var lngcopil;
    $.get('/monitor-children/childInfo',{
        id:copil.id
    },function (data) {
        latcopil = data['location_x'];
        lngcopil = data['location_y'];

        for(var indx in marker){
            var pozCopil=new google.maps.LatLng(latcopil,lngcopil);
                if(google.maps.geometry.spherical.computeDistanceBetween(pozCopil,marker[indx].getPosition())<=fences[indx].get('radius'))
                    poz = 1;
                else
                    poz = 0;
                if (poz != inout[indx]) {
                    inout[indx] = poz;
                    console.log(inout);
                    $.post("/points-of-interest/notification",
                        {
                            idPoint: marker[indx].get('id'),
                            idChild: copil.id,
                            poz: poz
                        },
                        function (data, status) {
                            return alert(data);
                        });
            }
        }

    });

}

function geofences(select) {
    distanta=document.getElementById('distanta').value;
    idCopil=document.getElementsByName('idCopil')[0].id;
    result = [];
    var options = select && select.options;
    var opt;

    for (var i=0, iLen=options.length; i<iLen; i++) {
        opt = options[i];

        if (opt.selected) {
            result.push(opt.value);
        }
    }
    if(result.length==0)
        return "Please select at least one point";
    else if(distanta<=0)
        return "Distance must pe greater then 0!";
    else {

        $.post("/points-of-interest/setGeofences",
            {
                idChild:idCopil,
                points:result,
                distance:distanta
            },
            function(data,status){
            });
        for(i=0;i<fences.length;i++){
            for(j=0;j<result.length;j++)
                if(fences[i].get('id')==result[j])
                    fences[i].setRadius(Number(distanta));
        }
        return "We set the geofences";
    }
}

function initFences(){
    for(var i=0;i<marker.length;i++){
        fences.push( new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: marker[i].getPosition(),
            radius: 0,
            id:marker[i].get('id')
        }));
    }

}

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
    for (var index in marker) {
        if (marker[index].get('id') == idPoint)
            marker[index].setMap(null);
        if(fences[index].get('id')==idPoint) {
            fences[index].setMap(null);
        }

    }
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
                var id=valoare['id'];
                inout.push(valoare['in_out']);
                createMarker(loc,name,id);
            });
        });
        zoom();
        initFences();
    });

    $.get('/points-of-interest/getGeofences',{
        id:copil.id
    },function (data) {
        $.each(data, function(index, value){
            $.each(value, function(index, valoare){
                var dist=valoare['distance'];
                var id=valoare['id_point'];
                setFence(dist,id);
            });
        });
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

function createMarker(loc,name,id) {
    marker.push(new google.maps.Marker({
        position: loc,
        icon: "http://maps.google.com/mapfiles/ms/micons/red.png",
        map: map,
        title:name,
        id:id
    }));
}

function setFence(distanta,id){
    for(var index in fences )
        if(fences[index].get('id')==id){
            fences[index].setRadius(Number(distanta));
        }
}

$(document).ready(function () {
    init();
    window.setInterval(function(){
        monitor();
    }, 1000);


});
