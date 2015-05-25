<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php print form::open(url::current(TRUE)) ?>
<h3>Рубрики</h3>
<div id="rubric_tabs" class="tabs">
    <ul>
        <li><a href="#rubric_browse">Обзор</a></li>
        <li><a href="#rubric_create">Создать корневую рубрику</a></li>
        <li><a href="#rubric_create_child">Создать подрубрику</a></li>

    </ul>
    <div id="rubric_browse">
        <table>
            <tr>
                <td>
                    <?php print form::dropdown(array('name' => 'selected_rubric_id', 'multiple' => 'multiple', 'size' => '12'), $rubrics); ?>
                </td>
                <td>
                    
                </td>
            </tr>
        </table>

    </div>
    <div id="rubric_create">
        <table>
            <tr>
                <td>
                    Описание:
                </td>
                <td>
                    <?php print form::input('create_rubric_name'); ?>
                </td>
                <td>
                    <?php print form::submit('create', 'Создать'); ?>
                </td>
            </tr>
        </table>

    </div>
    <div id="rubric_create_child">
        <table>

            <tr>
                <td>
                    Родительская рубрика:
                </td>

                <td>
                    <?php print form::dropdown('add_to_rubric_id', $parentRubrics); ?>
                </td>
                <td>
                    <?php print form::submit('add', 'Добавить'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Описание:
                </td>
                <td>
                    <?php print form::input('add_rubric_name'); ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<script language="javascript" type="text/javascript">

    function rubrics()
    {
        return $('#selected_rubric_id').get(0);
    }

    function getSelectedRubricName()
    {
        return rubrics().selectedIndex == -1 ? null : rubrics().options[rubrics().selectedIndex].text;
    }

    function getSelectedRubricId()
    {
        return rubrics().selectedIndex == -1 ? null : rubrics().options[rubrics().selectedIndex].value;
    }

    function attributeTypes()
    {
        return $('#selected_attribute_type_id').get(0);
    }

    function getSelectedAttributeTypeName()
    {
        return attributeTypes().selectedIndex == -1 ? null : attributeTypes().options[attributeTypes().selectedIndex].text;
    }

    function getSelectedAttributeTypeId()
    {
        return attributeTypes().selectedIndex == -1 ? null : attributeTypes().options[attributeTypes().selectedIndex].value;
    }

    function disableRubricRelated()
    {
        $('.rubric_related').slideUp();
    }

    function enableRubricRelated()
    {
        $('.rubric_related').slideDown();
    }

    function disableAttributeTypeRelated()
    {
        $('.attribute_type_related').slideUp();
    }

    function enableAttributeTypeRelated()
    {
        $('.attribute_type_related').slideDown();
    }

    $().ready( function() {

        $('.tabs').tabs();
        $('.accordion .head').click(function() { $(this).next().slideToggle()});

        $('#selected_rubric_id').bind('change', function()
        {
            if(getSelectedRubricId()) enableRubricRelated(); else disableRubricRelated();
            $('.selected_rubric_name').text( getSelectedRubricName());
            loadJson();
        });
        $('#selected_attribute_type_id').bind('change', function()
        {
            if(getSelectedAttributeTypeId()) enableAttributeTypeRelated(); else disableAttributeTypeRelated();

        });
    });
</script>
<?php print form::close(); ?>