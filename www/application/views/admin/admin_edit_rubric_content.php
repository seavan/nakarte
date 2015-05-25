<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3>Редактирование рубрики &laquo;<?php echo $rubric->name ?>&raquo;</h3>
<div id="object_tabs" class="tabs">
    <ul>
        <li><a href="#rubric_attributes_tab">Типы атрибутов</a></li>
    </ul>
    <div id="rubric_attributes_tab">
        <table cellspacing="10px" style="border-collapse: separate">
            <tr>
                <td>
                    <p>Для удаления типа атрибута выделите его и нажмите DEL</p>
                    <div id="rubric_types" class="object_rubrics"></div>
                </td>
                <td>
                    <p>Для добавления типа атрибута в рубрику - двойной щелчок</p>
                    <div id="all_types"></div>
                </td>
            </tr>
        </table>
    </div>

</div>
<script language="javascript" type="text/javascript">
    function addTypeToRubric(selectBox)
    {
        $.ajax({
            url: 'add_attribute_to_rubric/' + getSelectSelectedValue(selectBox),
            success: function()
            {
                $('#rubric_types').seavanSelectControl().jsonUpdate();
            }
        });
    }

    function removeTypeFromRubric(selectBox)
    {
        $.ajax({
            url: 'remove_attribute_from_rubric/' + getSelectSelectedValue(selectBox),
            success: function()
            {
                $('#rubric_types').seavanSelectControl().jsonUpdate();
            }
        });
    }

    $().ready( function() {

        $('#rubric_types').seavanSelectControl( {'update_url': 'rubric_list_attribute_types' }).jsonUpdate();

        $('#all_types').seavanSelectControl( {'update_url': '../../../json/attribute_types' }).jsonUpdate();

        $('#all_types').seavanSelectControl().dblclick( function() {  addTypeToRubric(this); } );

        $('#rubric_types').seavanSelectControl().keydown( function() { if(event.keyCode == 46) removeTypeFromRubric(this); } );

        $('.tabs').tabs();


    });
</script>
