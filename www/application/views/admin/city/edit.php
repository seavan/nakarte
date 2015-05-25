<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<font color=blue><?=html::anchor("/admin/cities", '[К списку городов]')?></font>
<hr>
<font color=blue><?=html::anchor("/admin/city/view/$city->id", '[Посмотреть]')?>
<?=html::anchor("/admin/city/delete/$city->id", '[Удалить]',array('onclick'=>'return confirm ("Действительно удалить город?")'))?></font>
<br />
<h3>Редактирование города <?=$city->name?> (<?=$city->kzname?>)</h3>
<?=$status?>
<? if (isset($errors)) {foreach ($errors as $error) {echo '<font color=red>'.$error.'</font><br />';} }
	$req ='<font color=red>  *</font>';?>
	<div id="YMapsID" style="width:400px;height:400px; float: right"></div>
<table>
	<tr>
			<td><b>Название: </b></td><td><?=form::input('name', $city->name).$req;?></td>
	</tr>
	<tr>
			<td><b>  Название (каз.): </b></td><td><?=form::input('kzname', $city->kzname).$req;?></td>
	</tr>
	<tr>
			<td><b>  Долгота: </b></td><td><?=form::input('lon', number_format($city->lon,4,'.',''))?><?=$req;?></td>
	</tr>
	<tr>
			<td><b>  Широта: </b></td><td><?=form::input('lat',number_format($city->lat,4,'.',''))?><?=$req;?></td>
	</tr>						
</table>

<p>Введите адрес и нажмите <b>[Enter]</b> для поиска города на карте:</p>    
    <input type="text" id="search_position" style="width: 350px" value="<? echo 'Казахстан, '.$city->name?>" />
    <a href="javascript:void();" onclick="javascript:reloadCoord()" style="color:green">Обновить координаты</a>
    <br />
    <br />

<input type="button" value="Сохранить" onclick="javascript:applyPosition()"/>

<br style="clear:both"/>

<script language="javascript" type="text/javascript">
   
    function applyPosition(_callback)
    {
       var x=placemark.getGeoPoint();       
       //map.hint.show(map.converter.coordinatesToLocalPixels(x),  x.toString(4));                  
         $.ajax({
			url: '/admin/city/edit/'+<?=$city->id?>,
            type: 'POST',
            data: { 
				'lat': $('#lat').get(0).value,
				'lon' : $('#lon').get(0).value,
				'lat_map': x.getY(),
                'lon_map': x.getX(),                
                'id': <?php echo $city->id ?>,
                'name': $('#name').get(0).value,
                'kzname': $('#kzname').get(0).value,
            },
            success: function(_response)
            {
                if(_callback) _callback();                                				
            }                      
             
        });         
    }
    function reloadCoord(){
		 var x=placemark.getGeoPoint();
		$('#lat').val(x.getY().toFixed(4));
        $('#lon').val(x.getX().toFixed(4));
         //if(_callback) _callback();
		}

    function createPlacemark (geoPoint, name, description) {
        var placemark = new YMaps.Placemark(geoPoint, {draggable: true});
        placemark.name = name;
        placemark.description = description;

        // Прикрепляет обработчики событий метки
        YMaps.Events.observe(placemark, placemark.Events.DragStart, function (obj) {
        });

        YMaps.Events.observe(placemark, placemark.Events.Drag, function (obj) {
            var current = obj.getGeoPoint().copy();
        });

        YMaps.Events.observe(placemark, placemark.Events.DragEnd, function (obj) {
            map.setCenter( placemark.getGeoPoint() );
            obj.update();
        });
        
        YMaps.Events.observe(map, map.Events.Click, function (map, obj) {
			placemark.setGeoPoint(obj.getGeoPoint());
			showCoord(placemark);
		});            
		
        return placemark;
    }

    function showCoord(obj) {
		var coord=obj.getGeoPoint();
                obj.setIconContent(coord.toString(4));
	}
	
    function showAddress (value, callback) {
        map.hint.hide();
        var geocoder = new YMaps.Geocoder(value, {results: 1, boundedBy: map.getBounds()});

        YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
            if (this.length()) {
                var geoResult = this.get(0);
                map.setBounds(geoResult.getBounds());
                cPoint = geoResult.getGeoPoint();                
                placemark.setGeoPoint(cPoint);
                showCoord(placemark);               
            }else {
                //alert("Ничего не найдено " + value)
            }
            callback();

        });
    }
    var map = null;
    var placemark = null;  

    $().ready( function() {
        map = new YMaps.Map(document.getElementById("YMapsID"));
        var point = new YMaps.GeoPoint(<?php echo sprintf("%F, %F", $city->lon, $city->lat) ?>);
        map.addControl(new YMaps.TypeControl());
        map.addControl(new YMaps.ToolBar());
        map.addControl(new YMaps.Zoom());
        map.addControl(new YMaps.MiniMap());
        map.addControl(new YMaps.ScaleLine());
        map.setCenter(point, 9);
        map.setMaxZoom(9);        
        placemark = createPlacemark(point,'','');        
	
		showCoord(placemark);

        var group = new YMaps.GeoObjectCollection();
        group.add(placemark);        
        map.addOverlay(group);
        var val = ($('#search_position').get(0).value);
        showAddress(val);                

        $('#search_position').keydown( function(event){

            if(event.keyCode == 13)
            {
                val = ($('#search_position').get(0).value);
                showAddress(val);                
                return false;
            }
        });

    }); 
</script>
