// var infowindow;
var map;
var stores = [];
var distances = [];
var closestDistributor = {};
var myLoc = {};
var $markers;
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
        content: '<span style="font-size: 25px; background: transparent; box-shadow: none;" class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>'
    });


    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
        // console.log($marker.html());
        // create info window
        var infowindow = new google.maps.InfoWindow({
            content     : $marker.html()
        });

        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });

    // google.maps.event.addListener(map, 'click', function() {
    //     infowindow.close();
    // });

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

    if( myLoc.lat && myLoc.lng ) {
        console.log(myLoc.lat, myLoc.lng);
        map.setCenter( new google.maps.LatLng(myLoc.lat, myLoc.lng) );
        map.setZoom( 12 );
    }
    // only 1 marker?
    else if( map.markers.length == 1 )
    {
        // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 12 );
    }
    else
    {

        map.setCenter( bounds.getCenter() );
        map.setZoom( 5 );
        // fit to bounds
        // map.fitBounds( bounds );
    }

}

jQuery(document).ready(function ($) {


    $('.rslides').responsiveSlides({
        auto: true,             // Boolean: Animate automatically, true or false
        speed: 1500,            // Integer: Speed of the transition, in milliseconds
        timeout: 7000,          // Integer: Time between slide transitions, in milliseconds
        pager: true,           // Boolean: Show pager, true or false
        nav: true,             // Boolean: Show navigation, true or false
        random: false,          // Boolean: Randomize the order of the slides, true or false
        pause: false,           // Boolean: Pause on hover, true or false
        pauseControls: true,    // Boolean: Pause when hovering controls, true or false
        prevText: '‹',   // String: Text for the 'previous' button
        nextText: '›',       // String: Text for the 'next' button
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

    function findClosestDistributor(position) {
        // console.log(position.coords);

        myLoc.lat = position.coords.latitude;
        myLoc.lng = position.coords.longitude;

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

        distributor_url = null;

        if ( -1 === closestDistributor.website.indexOf('://') ) {
            distributor_url = 'http://' + closestDistributor.website;
        }

        $newDistributor = $( '<div class="vcard"><div class="name">' + closestDistributor.name + '</div><div class="address">' + closestDistributor.address + '</div><div><a class="phone" href="tel:' + closestDistributor.phone + '">' + closestDistributor.phone + '</a></div><div><a class="email" href="mailto:' + closestDistributor.email + '">' + closestDistributor.email + '</a></div><div class="website"><a target="_blank" href="' + distributor_url + '">' + closestDistributor.website + '</a><div></div>' );

        console.log(closestDistributor);

        $('.nearest-dist .dist').html($newDistributor);

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
        geoLocateMe();
        $(this).find('> div').toggleClass('open');
    });

    if ( $('.page-hautaustoimistot').length > 0 ) {
        geoLocateMe();
        center_map( map );
    }

    $('.typeahead').typeahead({
      minLength: 3,
      highlight: true,
    },
    {
      name: 'distributors',
      source: substringMatcher(cities)
    });

    $('.typeahead').on('typeahead:selected typeahead:autocompleted', function (e, val) {

        // map.setZoom(17);
        // map.panTo(curmarker.position);

        $('.lahimmat-jalleenmyyjat').empty();

        $.each(distributors, function( index, dist ) {
            // console.log(val.value);
            if ( dist.city && dist.city.indexOf(val.value) > -1 ) {

                var distHTML = '<div class="vcard"><h2 class="name">' + dist.name + '</h2><div class="address">' + dist.address + '</div><div><a class="phone" href="tel:' + dist.phone + '">' + dist.phone + '</a></div><div><a class="email" href="mailto:' + dist.email + '">' + dist.email + '</a></div><div class="website"><a target="_blank" href="' + dist.websiteHREF + '">' + dist.website + '</a><div></div></div>';

                $('.lahimmat-jalleenmyyjat').append(distHTML);
            }

        });

        //console.log(e, val);


    });

    $( '.swipebox' ).swipebox();

    $( '.entry-content a[href$=".jpg"], .entry-content a[href$=".png"]' ).swipebox();

    $('#masthead').headroom({
        // vertical offset in px before element is first unpinned
        offset : 0,
        // scroll tolerance in px before state changes
        tolerance : 0,
        // or you can specify tolerance individually for up/down scroll
        tolerance : {
            up : 5,
            down : 0
        }
    });

    $('.menu-toggle').on('click', function() {
        $(this).parent('.main-navigation').toggleClass('is-active');
        // $('body').css({overflow: 'hidden', height: '100vh', position: 'fixed'});
    });

    $(document).on('click', '.is-active .sub-menu .has-children', function() {
        $(this).toggleClass('is-open');
    });

    $('.share-button > span').on('click', function() {
        $(this).hide().siblings('.soc').show();
    });

    $('.mobile select').change(function() {

        val = $(this).val();

        $('.lahimmat-jalleenmyyjat').empty();

        $.each(distributors, function( index, dist ) {

            if ( dist.city && dist.city.indexOf(val) > -1 ) {

                var distHTML = '<div class="vcard"><h2 class="name">' + dist.name + '</h2><div class="address">' + dist.address + '</div><div><a class="phone" href="tel:' + dist.phone + '">' + dist.phone + '</a></div><div><a class="email" href="mailto:' + dist.email + '">' + dist.email + '</a></div><div class="website"><a target="_blank" href="' + dist.websiteHREF + '">' + dist.website + '</a><div></div></div>';

                $('.lahimmat-jalleenmyyjat').append(distHTML);
            }

        });

    });

}); // jQuery(document).ready

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {

        // console.log(str.address);
        // var re = /, [0-9]{5} (.*), Finland/;
        // var newtext = str.address.replace(re, "$1");
        // console.log(newtext);

        // console.log(str.address);

      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });

    cb(matches);
    // console.log($markers);
  };
};

var cities = [];

$.each(distributors, function(i, distributor) {

    if ( distributor.website && distributor.website.indexOf('http://') < 0 ) {
        distributor.websiteHREF = 'http://' + distributor.website;
    }
    else {
        distributor.websiteHREF = distributor.website;
    }

    if (distributor.city && cities.indexOf(distributor.city) < 0) {
        // console.log(distributor);
        cities.push(distributor.city);
    }
});

// console.log(cities);