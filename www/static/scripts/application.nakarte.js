var application = new Object();

application.panToPoint = function(point)
{
	application.mainMapApi.yandexMapApi.setCenter(point, 15)
	//application.mainMapApi.yandexMapApi.setZoom(15);
}

application.getDefaultCityName = function()
{
	if(!application._defaultCityName)
		{
		application._defaultCityName = $('._citySelect .act').text();
	}
	return application._defaultCityName;
}

application.refreshMap = function()
{
	application.mainMapApi.yandexMapApi.redraw();
}

application.panToCity = function(city)
{
	application.findAddress('Казахстан, ' + city,
	function(geoResult) {
		//application.yandexMapApi.setBounds(geoResult.getBounds());
		cPoint = geoResult.getGeoPoint();
		application.panToPoint(cPoint);
	});
}

application.panToSearch = function(search)
{
	application.findAddress('Казахстан, ' + application.getDefaultCityName() + ', ' + search,
	function(geoResult) {
		//application.yandexMapApi.setBounds(geoResult.getBounds());
		cPoint = geoResult.getGeoPoint();
		application.panToPoint(cPoint);
		application.mainMapApi.createFlag(cPoint.getLat(), cPoint.getLng(), geoResult.text);
	});
}


application.panToDefault = function()
{
	/* auto detect */
	/*	if (YMaps.location) {
	center = new YMaps.GeoPoint(YMaps.location.longitude, YMaps.location.latitude);
	application.panToPoint(center);
	}
	else */
	{
		application.panToCity(application.getDefaultCityName());
	}
}

application.findAddress = function(address, callback)
{
	var geocoder = new YMaps.Geocoder(address, {
		results: 1,
		boundedBy: application.mainMapApi.yandexMapApi.getBounds()
	});

	YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
		if (this.length()) {
			var geoResult = this.get(0);
			callback(geoResult);
		}else {
			alert("Ничего не найдено " + value)
		}
	});
}

application.navigateToObject = function(objectId)
{
	window.location = "/poi/" + objectId;
}

application.searchPlace = function()
{
	whatPlace = application.$whatPlace.val();
	wherePlace = application.$wherePlace.val();

	if( whatPlace.length){
		application.mainMapApi.clearMap();
		application.searchPlaceUrl = '/json/search/' + whatPlace;
		application.$uiSearchPlaceHolder.jsonUpdate();
	}

	if( wherePlace.length ){
		application.mainMapApi.clearFlag();
		application.panToSearch(wherePlace);
	}

	// Set search parameters
	$.cookie('yandexSearchWhatPlace', whatPlace, {expires:30} );
	$.cookie('yandexSearchWherePlace', wherePlace, {expires:30} );
	$.cookie('yandexSearchLastQueryTime', (new Date()).getTime(), {expires:30});
}


application.logout = function()
{
	$.ajax({
		url: '/auth/logout',
		success: function() {
			window.location = "/";
		}
	});
}

application.login = function()
{
	email = $('#login_email').val();
	pass = $('#login_pass').val();
	$.ajax({
		url: '/auth/login',
		dataType: 'text',
		data:
		{
			'email': email,
			'pass': pass
		},
		type: 'POST',
		context: this,
		success: function(data)
		{
			if( data != 'success' )
				{
				$('#login_status').html(data);
			}
			else
				{
				window.location.reload();
			}
		}

	});

}

application.updateCaptcha = function()
{
	captchaUrl = '/captcha/default?' + (new Date()).getTime();
	$('#captcha').html("<img alt='Captcha' src='" + captchaUrl + "'/>");
	//return;
}

application.register = function()
{
	name = $('#reg_name').val();
	email = $('#reg_email').val();
	pass = $('#reg_pass').val();
	captcha = $('#reg_captcha').val();

	$.ajax({
		url: '/auth/register',
		dataType: 'text',
		data:
		{
			'name': name,
			'email': email,
			'pass': pass,
			'captcha': captcha
		},
		type: 'POST',
		context: this,
		success: function(data)
		{
			if( data != 'success' )
				{
				$('#reg_status').html(data);
				application.updateCaptcha();
			}
			else
				{
				window.location.reload();
			}
		}

	});
}

application.showSubRubrics = function()
{
	$this = $(this);
	cls = '_rubricDl ' + $this.attr('class');
	$rubricDl.attr('class', cls);


	$titleRubricText.text($this.text());
	$subRubricList.attr('rel', $this.attr('rel'));
	$subRubricList.jsonUpdate();

	$rubricSlider.animate( {
		'margin-left': -224
	}, 500,
	function() {
		$('._rubricWrap').animate( {
			width: 236
		}, 300);
		$rubricSlider.hide();
	}
	);
	$('._rubricTitle').addClass('back');
}

application.hideSubRubrics = function()
{
	$rubricSlider.show();
	$('._rubricWrap').width(224);
	$('._rubricSlider').animate( {
		'margin-left': 0
	}, 500, function()
	{
		$subRubricList.empty();
	});
}

application.addRubric = function($targetSelect, $sourceOption)
{
	rel = $sourceOption.attr('rel');
	$items = $targetSelect.find('option[rel=' + rel + ']');
	if( $items.length ) return;

	parentRel = $sourceOption.parent().attr('rel');
	$parentGroup = $targetSelect.find('optgroup[rel=' + parentRel + ']');
	if($parentGroup.length == 0)
		{
		$parentGroup = $targetSelect.append('<optgroup></optgroup>').children().last();
		$parentGroup.attr('label', $sourceOption.parent().attr('label'));
		$parentGroup.attr('rel', $sourceOption.parent().attr('rel'));
	}			

	$newItem = $parentGroup.append('<option></option>').children().last();
	$newItem.attr('rel', rel);
	$newItem.val(rel);
	$newItem.text($sourceOption.text());
	$newItem.dblclick( function() 
	{
		$this = $(this);
		$parent = $this.parent();
		$this.remove();
		if($parent.children().length == 0)
			{
			$parent.remove();
		}
	}
	);
}

application.mapSearchRubrics = function(obj)
{
	$checkedItems = $(obj).find('input:checked');
	application.mainMapApi.clearMap();
	if($checkedItems.length == 0) return;
	$q = new Array();
	$checkedItems.each( function() { $q.push($(this).attr('rel')) } );
	application.searchPlaceUrl = '/json/search_rubrics/' + $q.join(':');
	//	alert(application.searchPlaceUrl);
	application.$uiSearchPlaceHolder.jsonUpdate();
}

application.showSignIn = function($this)
{
	application.$registration.fadeOut(); 
	if(!application.$registration.hasClass('_popupActive')) 
	{
		$this.addClass('show');
		application.$sign.fadeIn('fast', function() { $('#login_email').focus() } );
		application.$sign.addClass('_popupRequest');
	}
	else 
	{
		$this.removeClass('show');
		application.$sign.fadeOut();
	}
}

application.showRegister = function($this)
{
	application.$sign.fadeOut(); 
	
	if(!application.$registration.hasClass('_popupActive')) 
	{
		$this.addClass('show');
		application.$registration.fadeIn('fast', function(){ $('#reg_email').focus() } ); 
		application.$registration.addClass('_popupRequest');
	}
	else
	{
		$this.removeClass('show');
		application.$registration.fadeOut();
	}
}

$( function()
{
	outerClickCheckerIn();
	
	
	application.$showMap = $('.mapDoor .show');
	application.$hideMap = $('.mapDoor .hide');
	application.$whatPlace = $('#searchwhat');
	application.$wherePlace = $('#searchwhere');

	application.$showMap.click( function() {
		application.$showMap.hide();
		application.$hideMap.show();
		application.map.animate( {
			height: 407
		}, 1000, application.refreshMap );
	});

	application.$hideMap.click( function() {
		application.$hideMap.hide();
		application.$showMap.show();
		application.map.animate( {
			height: 21
		}, 1000 );
	});

	$('.selectfiltr a').click(
	function()
	{
		$selectParent = $(this).parentsUntil('.selectfiltr').last();
		if($selectParent.hasClass('show'))
			{

			$selectParent.removeClass('show');
		}
		else
			{
			$selectParent.addClass('show');
		}
	});
	application.$uiSearchPlaceHolder =
	$('.ui-search-place-holder');

	application.$rubrics =
	$('._rubrics');

	var minLeft = 0;
	var maxRight = 0;
	var minTop = 0;
	var maxBottom = 0;
	var minLat = 0;
	var maxLat = 0;
	var minLon = 0;
	var maxLon = 0;

	application.$uiSearchPlaceHolder.jsonControl(
	{
		'getUpdateUrl': function() {
			return application.searchPlaceUrl
		},
		'prebind': function() {

			maxRight = maxBottom = -1000000000;
			minLeft = minTop = 1000000000;

			minLat = minLon = 10000;
			maxLon = maxLat = -100000;

		},

		'populateItem': function(obj, data, index)
		{
			point = new YMaps.GeoPoint(data.lon, data.lat);
			if( (point.getX() == 0) || (point.getY() == 0) )
				{
				return;
			}

			minLeft = Math.min(minLeft, point.getX());
			maxRight = Math.max(maxRight, point.getX());
			minTop = Math.min(minTop, point.getY());
			maxBottom = Math.max(maxBottom, point.getY());

			minLat = Math.min(minLat, point.getLat());
			maxLat = Math.max(maxLat, point.getLat());
			maxLon = Math.max(maxLon, point.getLng());
			minLon = Math.min(minLon, point.getLng());


			application.mainMapApi.createPlacemark(data.lat, data.lon, data.caption, data.id, data.rubric_class);

			//application.yandexMapApi.setCenter( new YMaps.GeoPoint(maxLon, minLat));
			//alert(index);
		},

		'rebind': function(obj, data)
		{
			if( data.length )
				{
				/*
				alert(minLon);
				alert(maxLon);
				alert(minLat);
				alert(maxLat);  */
				if( (minLat != 0) && (application.$wherePlace.val().length == 0) )
					{
					lb = new YMaps.GeoPoint(minLon, maxLat);
					tr = new YMaps.GeoPoint(maxLon, minLat);
					/*					application.yandexMapApi.setCenter( lb );
					alert('1');
					application.yandexMapApi.setCenter( tr );
					alert('2'); */
					bounds = new YMaps.GeoBounds( lb, tr);
					application.mainMapApi.yandexMapApi.setBounds(bounds);
					//application.yandexMapApi.setZoom(15);
				}
				//application.yandexMapApi.setBounds( new YMaps.GeoBounds( new YMaps.GeoPoint(minLeft, maxBottom), new YMaps.GeoPoint(minLeft, minTop)));
			}
			else
				{
				//alert('Ничего не найдено');
			}
		}
	});
	
	application.$sign = $('.sign');
	application.$signToggler = $('.signDoor');
	$().popup(application.$sign, application.$signToggler);
	
	application.$registration = $('.registration');
	application.$regToggler = $('.registDoor');
	$().popup(application.$registration, application.$regToggler);
	
	
	$('._autohide').focusin( function()
	{
		$(this).hide();
		$(this).next('input').focus();
	});

	$('._autohide').click( function()
	{
		$(this).hide();
		$(this).next('input').focus();
	});

	
	$('input[type=text],input[type=password]').focusin( function() {
		$(this).prev('._autohide').hide()
	} );
	$('input[type=text],input[type=password]').focusout( function() {
		if(!$(this).val().length)$(this).prev('._autohide').show()
	} );


	application.map = $('.ui-map');
	application.mainMapApi = application.map.yandexMap();

	application.panToDefault();
	if(application.map.hasClass('ui-closed')){
		application.$rubrics.hide();
	}

	$city_list = $('.selectCity .city');

	//$current_city = $('.selectCity .act');
	$('.selectCity .act').click( function(){ $city_list.fadeIn(); });

	/* city control */
	application.selectCity = function(_cityId)
	{
		$city_list.fadeOut();
		$.cookie("nakarte_city_id", _cityId);
		window.location.reload();
	};

	/* create poi controls */
	application.selectMap = $('._selectMap');
	application.selectMapApi = application.selectMap.yandexMap();	

	if( application.selectMapApi ){
		application.selectMapApi.panToDefault();

		application.$selectMapLocationText = $('#faddressplace');

		application.selectMapLocationEdit = function(_sender)
		{
			$sender = $(_sender);
			application.selectMapApi.panToSearch($sender.val(), 
			function(_geoResult)
			{
				application.$selectMapLocationText.val(_geoResult.text);
			});
		}
	}		

	
	(function(){

		var lastQueryTime = $.cookie('yandexSearchLastQueryTime');
		var ym = application.mainMapApi.yandexMapApi;
		var ymEvLoad;


		$('#searchwhat').val( $.cookie('yandexSearchWhatPlace') );
		$('#searchwhere').val( $.cookie('yandexSearchWherePlace') );

		// Restore search result
		if( lastQueryTime != null &&  (new Date()).getTime() - lastQueryTime < 3600000 ) // one hour
		{

			ymEvLoad = YMaps.Events.observe( ym, ym.Events.Update, function () {
				var coxy = application.mainMapApi.yandexMapApi.getCenter();


				coxy.setX( $.cookie('yandexSearchX') );
				coxy.setY( $.cookie('yandexSearchY') );

				ym.setCenter( coxy, $.cookie('yandexSearchZoom') ); //, mapType
				//ymEvLoad.cleanup();
				//ymEvLoad.disable();
			});

			//application.panToDefault();
			application.searchPlace();
		}


		YMaps.Events.observe(ym, ym.Events.SmoothZoomEnd, function(){
			$.cookie('yandexSearchZoom', application.mainMapApi.yandexMapApi.getZoom(), {expires:30} );
		});

		YMaps.Events.observe(ym, ym.Events.MoveEnd, function(){
			var coxy = application.mainMapApi.yandexMapApi.getCenter();

			$.cookie('yandexSearchX', coxy.getX(), {expires:30} );
			$.cookie('yandexSearchY', coxy.getY(), {expires:30} );
		});

	})();
	/*		*/

});