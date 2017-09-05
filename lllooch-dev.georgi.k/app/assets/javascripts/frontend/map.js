/*
 * Загружает yandex.maps в указанный контейнер
 */
var DynamicMap = function (el, address) {
    var map;

    var func = function (options) {

        map = new ymaps.Map(el[0], {
            center: [55.753994, 37.622093],
            zoom: 9,
            behaviors: ['default', 'scrollZoom']
        });

        var center = options['center'] ? options['center'] : [55.753994, 37.622093],
            bounds = options['bounds'] ? options['bounds'] : 14,
            placemark = options['placemark']
        ;

        if (placemark) map.geoObjects.add(placemark);

        map.setBounds(bounds, {
            checkZoomRange: true // проверяем наличие тайлов на данном масштабе.
        });
    };

    if (address) {
        Geocoder.show(address, func);
    }
};

var StaticMap = function (el, address) {
    var show = function (options) {

        var params = ['l=map'],
            center = options['center'] ? options['center'] : [55.753994, 37.622093],
            z = options['z'] ? options['z'] : 14
        ;

        params.push('size=' + [el.width(), el.height()].join(','));
        params.push('ll=' + center.reverse().join(','));
        params.push('z=' + z);
        params.push('pt=' + center.join(',') + ',pm2ntm');

        var map = $('<img>').attr('src', 'http://static-maps.yandex.ru/1.x/?' + params.join('&')),
            link = $('<a>').attr('href', 'http://maps.yandex.ru/?text=' + address).append(map)
        ;

        el.empty().append(link);
    };

    if (address) {
        Geocoder.show(address, show);
    }
};

var Geocoder = {
    show: function (address, func) {
        var init = function () {
            ymaps.geocode(address, {results: 1}).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates(),
                    bounds = firstGeoObject.properties.get('boundedBy')
                ;

                func({center: coords, bounds: bounds, placemark: firstGeoObject});
            });
        };

        ymaps.ready(init);
    }
};