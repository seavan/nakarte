<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3>Редактирование объекта</h3>

<table>
    <tr>
        <td>Город:</td>
	<td>
	    <?php $selection = (ORM::factory('city')->select_list('id','name')); 
            $selection=array(0=>'---')+$selection; 
            echo form::dropdown('city_id',$selection,$object->city_id,'style="width: 154px"');?>
	</td>
    </tr>
    <tr>
        <td>Наименование:</td>
        <td><input type="text" style="width:400px" id="caption" value="<?php echo $object->caption ?>"/></td>
        <td rowspan="2">
            <div style="margin:10px;">
		<?php if( isset($prevObjectId)) echo "<a href='../$prevObjectId/view'>&lt;&lt; Предыдущий</a>&nbsp;" ?>

		<?php if( isset($nextObjectId)) echo "&nbsp;|&nbsp;<a class='nextObject' href='../$nextObjectId/view'>Следующий &gt;&gt;</a>&nbsp;" ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>Описание:</td>
        <td><input type="text" style="width:400px" id="description" value="<?php echo $object->descr ?>"/></td>
    </tr>
    <tr>
        <td>Прошел модерацию:</td>
        <td><input type="checkbox"  id="moderated" value="true" <?php echo $object->state > 0 ? 'checked' : '' ?>/></td>
    </tr>
</table>
<input type="button" value="Изменить" onclick="javascript:applyPosition()"/>
<input type="button" value="Удалить объект" onclick="javascript:deleteObject()"/>
<hr/>
<div id="object_tabs" class="tabs">
    <ul>
        <li><a href="#object_rubrics_tab">Рубрики</a></li>
        <li><a href="#object_attributes_tab">Атрибуты</a></li>
        <li><a href="#object_photo_tab">Фото</a></li>
		<li><a href="#object_geo_tab">Расположение объекта</a></li>	
    </ul>
    <div id="object_rubrics_tab">
        <table cellspacing="10px" style="border-collapse: separate">
            <tr>
                <td>
                    <p>Для удаления из рубрики выделите ее и нажмите DEL</p>
                    <div id="object_rubrics" class="object_rubrics"></div>
                </td>
                <td>
                    <p>Для добавления в рубрику - двойной щелчок</p>
                    <div id="all_rubrics"></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="object_attributes_tab">
        <p>Атрибуты объекта (соответствуют рубрикам, к которым относится объект):</p>
        <div id="object_attributes"></div>
        <input type="button" id="apply_attributes" onclick="javascript:applyAttributes()" value="Применить"/>
    </div>
    <div id="object_photo_tab">
        <p>Фотографии объекта:</p>
        <a href="/admin/photo/add/<?=$object->id?>">Добавить фото</a>
		<div id="object_photo">
	    <? foreach($object_photo as $id=>$guid): ?>
			<ul>
			<li><a href="/userdata/photo/<?=$guid?>.jpg" target="_blank">'<?=html::image('userdata/photo/'.$guid.'.thumb.jpg')?></a><br />
			<a href="/admin/photo/view/<?=$id?>"  target="_blank">[Инфо]</a>
			<!--<a href="/admin/photo/edit/<?=$id?>/object">[Изменить]</a>-->
			<a href="/admin/photo/delete/<?=$id?>" onclick="return confirm ('Действительно удалить фото?')">[Удалить]</a></li>
			</ul>
		<? endforeach; ?>
		</div>        
    </div>
    <div id="object_geo_tab">
        <p>Расположение объекта:</p>
	<h3>Расположение объекта</h3>
	<p>Введите адрес и нажмите Enter:
	    <br/>
	    <input type="text" id="search_position" style="width: 350px" value="<?php echo $object->address ?>"/>

	</p>
	<p>
	    <input type="button" id="apply_position" onclick="javascript:applyPosition()" value="Применить"/>
	    <br/>
	    <!--    Тестовое (!!!):<br/>
		<input type="button" value="Обновить координаты " id="updateAll" onclick="javascript:nextPoint()" /> -->
	</p>
	<!--<div id="YMapsID" style="width:400px;height:400px; float: bottom"></div>-->
	</div>
	<div id="YMapsID" style="width:400px;height:400px; float: right"></div>
	
    
    
</div>
<br style="clear:both"/>
<script language="javascript" type="text/javascript">
    function deleteObject()
    {
        $.ajax({
            url: '/auth_json/delete_object/' + <?php echo $object->id ?> ,
            success: function()
            {
                window.location = '/admin/list_objects';
            }});
    }

    function applyPosition(_callback)
    {
        $.ajax({
            url: '/auth_json/edit_object',
            type: 'POST',
            data: { 'caption': $('#caption').get(0).value,
                'description': $('#description').get(0).value,
                'lat': map.getCenter().getY(),
                'lon': map.getCenter().getX(),
                'address':$('#search_position').get(0).value,
                'city':$('#city_id').get(0).value,
                'id': <?php echo $object->id ?>,
		'moderated': $('#moderated').attr('checked') ? 1 : 0
            },
            success: function(_response)
            {
                if(_callback) _callback();
            }
        });
    }

    function applyAttributes()
    {
        $('.attribute_values').each( function()
        {

            data = $(this).data('data');
            $.ajax({
                url: '/auth_json/edit_object_attribute',

                type: 'POST',
                data: {
                    'poi_id': <?php echo $object->id ?>,
                    'attribute_type_id': data.id,
                    'attribute_value': this.value,
                    'attribute_value_id': data.attribute_value_id
                },
                success: function(_response)
                {

                }
            })
        });
    }

    function addObjectToRubric(selectBox)
    {
        $.ajax({
            url: 'add_object_to_rubric/' + getSelectSelectedValue(selectBox),
            success: function()
            {
                $('#object_rubrics').seavanRubricControl().jsonUpdate();
                $('#object_attributes').jsonGrid().jsonUpdate();
            }
        });
    }

    function removeObjectFromRubric(selectBox)
    {
        $.ajax({
            url: 'remove_object_from_rubric/' + getSelectSelectedValue(selectBox),
            success: function()
            {
                $('#object_rubrics').seavanRubricControl().jsonUpdate();
                $('#object_attributes').jsonGrid().jsonUpdate();
            }
        });
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
        return placemark;
    }

    function showAddress (value, callback) {
        var geocoder = new YMaps.Geocoder(value, {results: 1, boundedBy: map.getBounds()});

        YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
            if (this.length()) {
                var geoResult = this.get(0);
                map.setBounds(geoResult.getBounds());
                cPoint = geoResult.getGeoPoint();
                placemark.setGeoPoint(geoResult.getGeoPoint());
                //setBalloonInfo(placemark, geoResult.getGeoPoint(), geoResult.text);
                //placemark.openBalloon();
            }else {
                //alert("Ничего не найдено " + value)
            }
            callback();

        });
    }
    var map = null;
    var placemark = null;

    function readPoiAttribute(_data)
    {
        $(this).append(
        "<p>" + _data.caption + "<br/>" + "<input class='attribute_values' type='text' style='width:600px' value='" + _data.attribute_value
            + "'/></p>");
        $('.attribute_values').last().data('data', _data);
    }


    function showAddress (value, callback) {
        var geocoder = new YMaps.Geocoder(value, {results: 1, boundedBy: map.getBounds()});

        YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
            if (this.length()) {
                var geoResult = this.get(0);
                map.setBounds(geoResult.getBounds());
                cPoint = geoResult.getGeoPoint();
                placemark.setGeoPoint(geoResult.getGeoPoint());
                map.setCenter(geoResult.getGeoPoint());
                callback(cPoint);
            }
            else {
                //                alert("Ничего не найдено " + value)
            }

        });
    }

    function nextPoint()
    {
        current = $('#search_position').get(0).value;

        showAddress(current, function(point)
        {
            applyPosition(function()
            {
                if( $('.nextObject').length )
                {
                    window.location = $('.nextObject').attr('href') + '?nextPoint';
                }
            }
        );
        });
    }

    function sendInfo(id, lat, lon)
    {
        $.ajax({ url: '/map/update', context: document.body, success: nextPoint,
            data: { 'id' : id, 'lat': lat, 'lon': lon} });
    }


    $().ready( function() {
        map = new YMaps.Map(document.getElementById("YMapsID"));
        var point = new YMaps.GeoPoint(<?php echo sprintf("%F, %F", $object->lon, $object->lat) ?>);
        map.addControl(new YMaps.TypeControl());
        map.addControl(new YMaps.ToolBar());
        map.addControl(new YMaps.Zoom());
        map.addControl(new YMaps.MiniMap());
        map.addControl(new YMaps.ScaleLine());
        map.setCenter(point, 10);
        placemark = createPlacemark(point, 'Расположение объекта', 'Расположение объекта');

        var group = new YMaps.GeoObjectCollection();
        group.add(placemark);
        map.addOverlay(group);


        $('#object_rubrics').seavanRubricControl( {'update_url': 'list_rubrics' }).jsonUpdate();

        $('#object_attributes').jsonGrid( {'update_url': '/json/object_list_attributes/' + <?php echo $object->id ?>,
            'populateItem' : readPoiAttribute}).jsonUpdate();

        $('#all_rubrics').seavanRubricControl( {'update_url': '../../../json/rubrics' }).jsonUpdate();

        $('#all_rubrics').seavanRubricControl().dblclick( function() { addObjectToRubric(this); } );

        $('#object_rubrics').seavanRubricControl().keydown( function(event) { if(event.keyCode == 46) removeObjectFromRubric(this); } );

        $('#search_position').keydown( function(event){

            if(event.keyCode == 13)
            {
                val = ($('#search_position').get(0).value);
                showAddress(val);
                return false;
            }
        });
        $('.tabs').tabs();

        if(window.location.search.indexOf('nextPoint') != -1)
            nextPoint();
    });
</script>
