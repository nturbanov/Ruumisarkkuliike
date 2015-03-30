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

    var styles = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

    // create map
    var map = new google.maps.Map( $el[0], args);

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

    // create marker
    var marker = new google.maps.Marker({
        position    : latlng,
        map         : map
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
        map.setZoom( 16 );
    }
    else
    {
        // fit to bounds
        map.fitBounds( bounds );
    }

}

var stores = new Array();
// var distributors = [];
var distances = [];
var closestDistributor;
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
            navigator.geolocation.getCurrentPosition(closestDistributor, geoError);
            // get_distributors();
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

    function closestDistributor(position) {
        // console.log(position);

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

        // secondClosestDistributor = distributors[minIndex+1];

        // thirdClosestDistributor = distributors[minIndex+2];

        // fourthClosestDistributor = distributors[minIndex+3];

        // console.log(distributors);

        $newDistributor = $( '<div class="vcard"><div>' + closestDistributor.name + '</div><div>' + closestDistributor.address + '</div><div>' + closestDistributor.phone + '</div><a href="' + closestDistributor.website + '">' + closestDistributor.website + '</a></div>' );

        $('.nearest-dist p').after($newDistributor);

        // $newDistributor1 = $( '<div><h2>' + secondClosestDistributor.name + '</h2><p>' + secondClosestDistributor.address + '</p><p>' + secondClosestDistributor.phone + '</p><a href="' + secondClosestDistributor.website + '">' + secondClosestDistributor.website + '</a></div>' );
        // $newDistributor2 = $( '<div><h2>' + thirdClosestDistributor.name + '</h2><p>' + thirdClosestDistributor.address + '</p><p>' + thirdClosestDistributor.phone + '</p><a href="' + thirdClosestDistributor.website + '">' + thirdClosestDistributor.website + '</a></div>' );
        // $newDistributor3 = $( '<div><h2>' + fourthClosestDistributor.name + '</h2><p>' + fourthClosestDistributor.address + '</p><p>' + fourthClosestDistributor.phone + '</p><a href="' + fourthClosestDistributor.website + '">' + fourthClosestDistributor.website + '</a></div>' );

        // $('.lahimmat-jalleenmyyjat').append($newDistributor, $newDistributor1, $newDistributor2, $newDistributor3);
    }

    // function doStuff() {
    //     $.get('/jalleenmyyjat/',function(content){
    //         $content = $('<div>').html(content);
    //         $content.find('.jalleenmyyja').each( function(i) {
    //             var jalleenmyyja = {
    //                                 id:i,
    //                                 name:$(this).find('.organization-name').text(),
    //                                 address:$(this).find('.address').text(),
    //                                 tel:$(this).find('.tel').text(),
    //                                 url:$(this).find('.url').text()
    //                                 };

    //             distributors.push(jalleenmyyja);
    //         });
    //         console.log(distributors);
    //         initialize();
    //     });
    // }

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