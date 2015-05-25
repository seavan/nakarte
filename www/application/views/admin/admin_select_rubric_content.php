<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3>Выбор рубрики</h3>
<p>Выберите рубрику двойным щелчком</p>
<div id="all_rubrics"></div>
<script language="javascript" type="text/javascript">


    $().ready( function() {
        $('#all_rubrics').seavanRubricControl( {'update_url': '../../../json/rubrics', 'size': 30 }).jsonUpdate();
        $('#all_rubrics').seavanRubricControl().dblclick( function()
        {
            window.location = "edit_rubric/" + getSelectSelectedValue(this) + '/view';
        });
    });
</script>
