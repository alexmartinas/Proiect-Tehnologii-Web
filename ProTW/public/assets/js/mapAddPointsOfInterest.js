/**
 * Created by alex on 08.06.2017.
 */

var result = [];
var latitudine;
var longitudine;
var nume;

function getSelectValues(select) {
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
        return "Please select at least one children";
    else if(nume==null)
        return "Please click on the location marker!";
    else {

        $.post("/points-of-interest/addPoints",
            {
                name: nume,
                lat: latitudine,
                lng: longitudine,
                children:result
            },
            function(data,status){
            });
        return "We saved the point";
    }
}

var map;
var markers = new Array;

function initAutocomplete() {
    map = new google.maps.Map(document.getElementById('mapAddPoints'), {
        center: {lat: 46.8688, lng: 26.2195},
        zoom: 8,
        mapTypeId: 'roadmap'
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function (marker) {
            marker.setMap(null);
        });
        markers = new Array;

        var indx=0;

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

        });

        for(var i=0;i<markers.length;i++) {
            (function(){
                markers[i].addListener( 'click', listener.bind( null, i));
            }())
        }

        function listener(index) {
            map.setCenter(new google.maps.LatLng(markers[index]['position'].lat(), markers[index]['position'].lng()));
            map.setZoom(17);
            latitudine=markers[index]['position'].lat();
            longitudine=markers[index]['position'].lng();
            nume=markers[index]['title'];

        }
        map.fitBounds(bounds);
    });

}

$(document).ready(function () {

    initAutocomplete();

});

