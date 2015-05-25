<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
    // Создает метку
    function createPlacemark (geoPoint, name, description) {
        var placemark = new YMaps.Placemark(geoPoint);
        placemark.name = name;
        placemark.description = description;

        return placemark;
    }

    var map;
    var placemark;
    var cPoint;

    $().ready( function () {
        map = new YMaps.Map(document.getElementById("YMapsID"));
        var point = new YMaps.GeoPoint(37.678514, 55.758255);
        placemark = createPlacemark(point, 'Москва (Самокатная)', 'Москва, ул. Самокатная, дом 1, строение 21');
        var group = new YMaps.GeoObjectCollection();
        group.add(placemark);
        map.addOverlay(group);
        map.setCenter(point, 10);
        map.addControl(new YMaps.TypeControl());
        map.addControl(new YMaps.ToolBar());
        map.addControl(new YMaps.Zoom());
        map.addControl(new YMaps.MiniMap());
        map.addControl(new YMaps.ScaleLine());
        placemark.openBalloon();
        //showAddress('Алма-Ата');
        //loadJson();
    });

    function showAddress (value, callback) {
        var geocoder = new YMaps.Geocoder(value, {results: 1, boundedBy: map.getBounds()});

        YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
            if (this.length()) {
                var geoResult = this.get(0);
                map.setBounds(geoResult.getBounds());
                cPoint = geoResult.getGeoPoint();
                placemark.setGeoPoint(geoResult.getGeoPoint());
                setBalloonInfo(placemark, geoResult.getGeoPoint(), geoResult.text);
                placemark.openBalloon();
                callback(cPoint);
            }else {
                alert("Ничего не найдено " + value)
            }

        });
    }

    function setBalloonInfo (placemark, geoPoint, text) {
        var content = '';
        if (text) {
            content += '<div class="title">' + text + '</div>';
        }
        content += '<span class="coords-title"> Координаты: </span>' + geoPoint.toString();
        placemark.setBalloonContent(content);
        document.getElementById('coords').value = geoPoint.toString();

    }

    var data;
    var index = 0;

    function loadJson()
    {
        $.getJSON('/cities', function(_data) {
            data = _data.result;
            nextPoint();
        });
    }

    function nextPoint()
    {
        if( index >= data.length )
            return;
        current = data[index];
        ++index;
        showAddress('Казахстан, ' + current.name, function(point)
        {
            sendInfo(current.id, point.getLat(), point.getLng());
        });


    }

    function sendInfo(id, lat, lon)
    {
        $.ajax({ url: '/map/update', context: document.body, success: nextPoint,
            data: { 'id' : id, 'lat': lat, 'lon': lon} });
    }
</script>
<?= isset($userinfo)? $userinfo : '' ?>
<p><a href="javascript:loadJson()">Обновить координаты всех городов через Яндекс</a></p>
<h4>Найти:</h4>

<?= isset($content)? $content : '' ?>
<div>
    <div style="float: right">
        <div id="YMapsID" style="width:600px;height:400px;"></div>
        <p>Координаты: <input id="coords" type="text"/></p>
        <div id="result"></div>
    </div>
</div>
