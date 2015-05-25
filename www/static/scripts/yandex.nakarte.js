/// user functions for creating Yandex.maps
/// used classes
/// ui-yandex-map


(function($){


	$.fn.yandexMap = function() {
		if( this.length == 0 ) return null;
		$this = $(this.get(0));
		$this.addClass('ui-yandex-map');

		yapi = new Object();
		yapi.yandexMapApi = new YMaps.Map($this.get(0));
		yapi.yandexMapApi.addControl(new YMaps.Zoom());
		yapi.$yandexOverlay = new YMaps.GeoObjectCollection();
		yapi.$flagOverlay = new YMaps.GeoObjectCollection();

		yapi.yandexMapApi.addOverlay(yapi.$yandexOverlay);
		yapi.yandexMapApi.addOverlay(yapi.$flagOverlay);

		yapi.clearMap = function()
		{
			this.$yandexOverlay.removeAll();
		}

		yapi.clearFlag = function()
		{
			this.$flagOverlay.removeAll();
		}


		yapi.createPlacemark = function(lat, lon, caption, objectId, cls)
		{
			if(this.yandexMapApi)
				{
				// Создает стиль
				s = new YMaps.Style();
				// Создает стиль значка метки
				s.iconStyle = new YMaps.IconStyle();
				s.iconStyle.href = "/static/i/bubbles/" + cls + ".png";
				s.iconStyle.size = new YMaps.Point(24, 32);
				s.iconStyle.offset = new YMaps.Point(-12, -32);
				placemark = new YMaps.Placemark(new YMaps.GeoPoint(lon, lat), {style: s});

				placemark.name = caption;
				placemark.description = caption;
				placemark.objectId = objectId;
				// Добавляет метку на карту
				this.$yandexOverlay.add(placemark);
				YMaps.Events.observe(placemark,
				placemark.Events.Click,
				function (placemark, e) {
					application.navigateToObject(placemark.objectId);

				});
			}

		}

		yapi.createFlag = function(lat, lon, caption)
		{
			if(this.yandexMapApi)
				{
				placemark = new YMaps.Placemark(new YMaps.GeoPoint(lon, lat), {draggable: true});
				placemark.name = caption;
				placemark.description = caption;
				// Добавляет метку на карту
				this.$flagOverlay.add(placemark);
				sender = this;

				YMaps.Events.observe(placemark, placemark.Events.DragStart, function (obj) {
				});

				YMaps.Events.observe(placemark, placemark.Events.Drag, function (obj) {
					var current = obj.getGeoPoint().copy();
				});

				YMaps.Events.observe(placemark, placemark.Events.DragEnd, function (obj) {
					sender.yandexMapApi.setCenter( placemark.getGeoPoint() );
					obj.update();
				});				
			}
		}

		yapi.panToPoint = function(point)
		{
			this.yandexMapApi.setCenter(point)
			this.yandexMapApi.setZoom(15);
		}		

		yapi.panToCity = function(city)
		{
			application.findAddress('Казахстан, ' + city,
			function(geoResult) {
				//application.yandexMapApi.setBounds(geoResult.getBounds());
				cPoint = geoResult.getGeoPoint();
				yapi.panToPoint(cPoint);
			});
		}

		yapi.panToSearch = function(search, callback)
		{
			sender = this;
			this.findAddress('Казахстан, ' + application.getDefaultCityName() + ', ' + search, function(geoResult) {
				//application.yandexMapApi.setBounds(geoResult.getBounds());
				cPoint = geoResult.getGeoPoint();
				sender.panToPoint(cPoint);
				sender.createFlag(cPoint.getLat(), cPoint.getLng(), geoResult.text);
				if(callback) callback(geoResult);
			});
		}


		yapi.panToDefault = function()
		{
			/* auto detect */
			/*	if (YMaps.location) {
			center = new YMaps.GeoPoint(YMaps.location.longitude, YMaps.location.latitude);
			application.panToPoint(center);
			}
			else */
			yapi.panToCity(application.getDefaultCityName());
		}			

		yapi.findAddress = function(address, callback, callback2)
		{
			geocoder = new YMaps.Geocoder(address, {
				results: 1,
				boundedBy: this.yandexMapApi.getBounds()
			});
			
			YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
				if (this.length()) {
					var geoResult = this.get(0);
					if(callback) callback(geoResult);
					coords = geoResult.getGeoPoint().toString();

					
				}else {
					alert("Ничего не найдено по адресу: " + value)
				}
			});
		}
		return yapi;
	}


})(jQuery);
