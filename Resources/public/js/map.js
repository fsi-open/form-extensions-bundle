define(['jquery', 'google-maps'], function($, googleMaps) {

    $.fn.fsiMap = function(options) {

        options = $.extend({
            latitudeSelector: '.latitude-field',
            longitudeSelector: '.longitude-field',
            zoomSelector: '.zoom-field',
            mapWrapperSelector: '.map-location__map',
            initializedClass: 'map-location--initialized',
            defaultLatitude: 52,
            defaultLongitude: 20,
            zoom: 6
        }, options);

        var normalizeNumber = function(number) {
            return parseFloat(number.replace(',','.'));
        }

        this.each(function() {
            var $el = $(this),
                latitudeField = $el.find(options.latitudeSelector),
                longitudeField = $el.find(options.longitudeSelector),
                zoomField = $el.find(options.zoomSelector),
                mapWrapper = $el.find(options.mapWrapperSelector),
                location,
                defaultLocation,
                latitude,
                longitude,
                map,
                marker;

            if (!latitudeField.length || !longitudeField.length || !mapWrapper.length) {
                return;
            }

            if (latitudeField.val() && longitudeField.val()) {
                location = {
                    lat: normalizeNumber(latitudeField.val()),
                    lng: normalizeNumber(longitudeField.val())
                };
            } else {
                defaultLocation = {
                    lat: options.defaultLatitude,
                    lng: options.defaultLongitude
                };
            }

            //add class that hides field and set map size
            $el.addClass(options.initializedClass);

            map = new googleMaps.Map(mapWrapper[0], {
                center: location || defaultLocation,
                zoom: zoomField.val() ? normalizeNumber(zoomField.val()) : options.zoom,
                scrollwheel: false
            });

            mapWrapper.data('google-map', map);

            if (!zoomField.val()) {
                zoomField.val(map.getZoom());
            }

            marker = new googleMaps.Marker({
                map: map,
                draggable: true
            });

            $el.data('google-map', {
                map: map,
                location: location || defaultLocation,
                marker: marker
            });

            if (location) {
                marker.setPosition(location);
            }

            //when click on map set marker location
            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
            });

            //when zoom is changed on map
            google.maps.event.addListener(map, 'zoom_changed', function(event) {
                zoomField.val(this.getZoom());
            });

            //when marker location changed update form fields
            google.maps.event.addListener(marker, 'position_changed', function(event) {
                latitudeField.val(this.position.lat());
                longitudeField.val(this.position.lng());
            });

            var updateMap = function() {
                var lat = normalizeNumber(latitudeField.val()),
                    lng = normalizeNumber(longitudeField.val()),
                    position;
                if (lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
                    position = {lat: lat, lng: lng};
                    map.setCenter(position);
                    marker.setPosition(position);
                    marker.setVisible(true);
                } else {
                    marker.setVisible(false);
                }
                map.setZoom(normalizeNumber(zoomField.val()));
            };
            latitudeField.on('change', updateMap);
            longitudeField.on('change', updateMap);
            zoomField.on('change', updateMap);
        });

        return true;
    };

});
