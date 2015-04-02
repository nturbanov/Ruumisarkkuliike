/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type    function
*  @date    8/11/2013
*  @since   4.3.0
*
*  @param   $el (jQuery element)
*  @return  n/a
*/

function render_map( $el ) {

    // var
    $markers = $el.find('.marker');

    // vars
    var args = {
        zoom        : 16,
        center      : new google.maps.LatLng(0, 0),
        mapTypeId   : google.maps.MapTypeId.ROADMAP
    };

    var styles = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];

    // create map
    map = new google.maps.Map( $el[0], args);

    map.setOptions({styles: styles});

    // add a markers reference
    map.markers = [];

    // add markers
    $markers.each(function(){

        add_marker( $(this), map );

    });

    // center map
    center_map( map );

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type    function
*  @date    8/11/2013
*  @since   4.3.0
*
*  @param   $marker (jQuery element)
*  @param   map (Google Map object)
*  @return  n/a
*/

function add_marker( $marker, map ) {

    // var
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

    // create marker
    // var marker = new google.maps.Marker({
    //     position    : latlng,
    //     map         : map,
    //     iconBase    : iconBase + 'schools_maps.png'
    // });

    var marker = new RichMarker({
          position: latlng,
          map: map,
          draggable: false,
          shadow: false,
          content: '<span style="font-size: 40px; background: transparent; box-shadow: none;" class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>'
          });


    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
        // create info window
        var infowindow = new google.maps.InfoWindow({
            content     : $marker.html()
        });

        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function() {

            infowindow.open( map, marker );

        });
    }

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type    function
*  @date    8/11/2013
*  @since   4.3.0
*
*  @param   map (Google Map object)
*  @return  n/a
*/

function center_map( map ) {

    // vars
    var bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){

        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

        bounds.extend( latlng );

    });

    // only 1 marker?
    if( map.markers.length == 1 )
    {
        // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 12 );
    }
    else if( myLoc.lat && myLoc.lng ) {
        console.log(myLoc.lat);
        map.setCenter( new google.maps.LatLng(myLoc.lat, myLoc.lng) );
        map.setZoom( 12 );
    }
    else
    {
        // fit to bounds
        map.fitBounds( bounds );
    }

}

var map;
var stores = [];
// var distributors = [];
var distances = [];
var closestDistributor = {};
var myLoc = {};
var $markers;

jQuery(document).ready(function ($) {


    $('.rslides').responsiveSlides({
        auto: true,             // Boolean: Animate automatically, true or false
        speed: 500,            // Integer: Speed of the transition, in milliseconds
        timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
        pager: false,           // Boolean: Show pager, true or false
        nav: false,             // Boolean: Show navigation, true or false
        random: false,          // Boolean: Randomize the order of the slides, true or false
        pause: false,           // Boolean: Pause on hover, true or false
        pauseControls: true,    // Boolean: Pause when hovering controls, true or false
        prevText: 'Previous',   // String: Text for the 'previous' button
        nextText: 'Next',       // String: Text for the 'next' button
        maxwidth: '',           // Integer: Max-width of the slideshow, in pixels
        navContainer: '',       // Selector: Where controls should be appended to, default is after the 'ul'
        manualControls: '',     // Selector: Declare custom pager navigation
        namespace: 'rslides',   // String: Change the default namespace used
        before: function(){},   // Function: Before callback
        after: function(){}     // Function: After callback
    });

    $('.acf-map').each(function(){

        render_map( $(this) );

    });

    function geoError(error) {
        // $('.preloaderx').fadeOut();
        console.log(error.code);
    }

    function geoLocateMe() {
        // One-shot position request
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(findClosestDistributor, geoError, {timeout: 30000, enableHighAccuracy: true, maximumAge: 75000});
            // get_distributors();
            // console.log('yes GeoLocation support');
            // navigator.geolocation.getCurrentPosition( function(position) {
            //   myLoc.lat = position.coords.latitude;
            //   myLoc.lng = position.coords.longitude;
            // });

        } else {
            console.log('no GeoLocation support');
        }
    }
    geoLocateMe();

    // function get_distributors() {
    //     $markers.each(function( index ) {
    //         // console.log( $( this ).find('h4').text() );
    //         this_dist = {
    //             name : $( this ).find('h4').text(),
    //             address : $( this ).find('.address').text(),
    //             phone : $( this ).find('.puhnro').text(),
    //             website : $( this ).find('a').attr('href'),
    //             latitude : $( this ).attr('data-lat'),
    //             longitude : $( this ).attr('data-lng')
    //         };
    //         // console.log(this_dist);
    //         distributors.push(this_dist);
    //     });

    //     console.log(distributors);
    // }

    function geoCallback(position) {
        var distances = new Array();
        for (var i = 0; i < stores.length; i++) {
            distances.push(
                lineDistance(
                    {x:position.coords.latitude, y:position.coords.longitude},
                    {x:stores[i][2], y:stores[i][3]})
            );
        };
        // console.log(distances);
        var i = distances.indexOf(Math.min.apply(Math, distances));
        // $('.section5 .answers:nth-child(' + i + ')').click();
        //if (!storeSelected) $('.section4 .answers .answer:nth-child(' + (i+1) + ')').click();
        //$('.preloaderx').fadeOut();

        //console.log('closest shop: ' + stores[i][0]);
        // console.log('latitude: ' + position.coords.latitude);
        // console.log('longitude: ' + position.coords.longitude);
    }

    function findClosestDistributor(position) {
        // console.log(position.coords);

        myLoc.lat = position.coords.latitude;
        myLoc.lng = position.coords.longitude;

        center_map( map );

        distributors.forEach(function (distributor) {
            //console.log(obj);
            getLocation(distributor, position);
            //var minimum = Array.min(array);
        });

        var min = distances[0];
        var minIndex = 0;

        for (var i = 1; i < distances.length; i++) {
            if (distances[i] < min) {
                minIndex = i;
                min = distances[i];
            }
        }

        closestDistributor = distributors[minIndex];

        $newDistributor = $( '<div class="vcard"><div>' + closestDistributor.name + '</div><div>' + closestDistributor.address + '</div><div>' + closestDistributor.phone + '</div><a href="' + closestDistributor.website + '">' + closestDistributor.website + '</a></div>' );

        $('.nearest-dist > div').prepend($newDistributor);

    }


    function getLocation(distributor, position) {
        //console.log(position);
        var latLngA = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        var latLngB = new google.maps.LatLng(distributor.lat, distributor.lng);
        var distance = google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB);
        //console.log(distance);//In metres
        distances.push(distance);
    }

    $('.nearest-dist').click( function() {
        // console.log('wh');
        $(this).find('div').toggleClass('open');
    });

}); // jQuery(document).ready