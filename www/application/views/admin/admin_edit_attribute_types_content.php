<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3>Редактирование типов атрибутов</h3>
<div id="object_tabs" class="tabs">
    <ul>
        <li><a href="#rubric_attributes_tab">Типы атрибутов</a></li>
    </ul>
    <div id="rubric_attributes_tab">
        <table cellspacing="10px" style="border-collapse: separate">
            <tr>
                <td>
                    <p>Для удаления типа атрибута выделите его и нажмите DEL:</p>
                    <div id="attribute_types"></div>
                </td>
                <td>
                    <p>Создать новый тип атрибута:</p>
                    <p>Описание:<br/>
                        <input type="text" id="caption"/></p>
                    <p>Тип данных:<br/>
                        <span id="data_types"></span>
                    </p>
                    <input type="button" onclick="javascript:createTypeAttribute()" value="Создать"/>
            </tr>
        </table>
    </div>

</div>
<script language="javascript" type="text/javascript">
    function removeAttributeType(selectBox)
    {
        $.ajax({
            url: '/auth_json/delete_attribute_type/' + getSelectSelectedValue(selectBox),
            success: function()
            {
                $('#attribute_types').seavanSelectControl().jsonUpdate();
            }
        });
    }

    function createTypeAttribute()
    {
        $.ajax({
            url: '/auth_json/create_attribute_type',
            data: {'caption': $('#caption').get(0).value, 'type_index':
                    getSelectSelectedValue($('#data_types').seavanSelectControl().get(0))},
            success: function()
            {
                $('#attribute_types').seavanSelectControl().jsonUpdate();
            }
        });
    }

    $().ready( function() {

        $('#attribute_types').seavanSelectControl( {'update_url': '/json/attribute_types' }).jsonUpdate();
        $('#data_types').seavanSelectControl( {'update_url': '/json/get_data_types', 'size': 4 }).jsonUpdate();

        $('#attribute_types').seavanSelectControl().keydown( function(event) { if(event.keyCode == 46) removeAttributeType(this); } );

        $('.tabs').tabs();


    });
</script>
