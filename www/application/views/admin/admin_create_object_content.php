<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3>Создание объекта</h3>
<div id="object_tabs" class="tabs">
    <ul>
        <li><a href="#rubric_attributes_tab">Создать объект</a></li>
    </ul>
    <div id="rubric_attributes_tab">
        <p>Наименование объекта:<br/>
            <input type="text" style="width:600px" id="caption"/>
        </p>
        <p>Описание объекта:<br/>
            <input type="text" style="width:600px" id="description"/>
        </p>
        <p>Город:<br/>            
            <?php $selection = (ORM::factory('city')->select_list('id','name')); 
            $selection=array(0=>'---')+$selection; 
            echo form::dropdown('city',$selection,$this->input->post('city'),'style="width: 154px"');?>
        </p>
        <input type="button" value="Создать" onclick="javascript:createPoiObject()"/>
    </div>

</div>
<script language="javascript" type="text/javascript">
    function createPoiObject()
    {
        $.ajax({
            url: '/auth_json/create_object',
            type: 'POST',
            data: { 'caption': $('#caption').get(0).value, 'description': $('#description').get(0).value, 'city': $('#city').get(0).value },
            success: function(_response)
            {
                id = parseInt(_response);
                window.location = 'object/' + id + '/view';
            }
        });
    }

    $().ready( function() {

        $('.tabs').tabs();


    });
</script>
