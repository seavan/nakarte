<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="city_count_list">
    <?php

    $cities = Database::instance()->query("SELECT * FROM cities_count");
    foreach($cities as $city)
	{
//	    echo "<span><a href='/admin/list_objects_city/$city->id'>$city->name</a> ($city->poi_count)</span>";
	}

    ?>
    <br style="clear: both"/>
</div>
<h3>Список объектов</h3>
<p><?php echo $pagination ?></p>
<table>
    <tr>
        <td>
	    <?php
	    $colCount = 4;

	    $objPerCol = (int)($objCount / $colCount);

	    $i = $objPerCol * $colCount - $objCount + 1;
//            echo $objPerCol;
	    $lastCityId = null;

	    foreach($limit_objects as $object)
	    {
		if($i > $objPerCol)
		{
		    $i = 0;
		    echo "</td><td>";
		}
		if( $object->city->id != $lastCityId )
		{
		    if( $lastCityId )
		    {
			echo "<br/>";
		    }
		    echo "<div class='alpha_head'>".html::anchor("/admin/list_objects_city/".$object->city->id, $object->city->name )."</div>";
		    $lastCityId = $object->city->id;
		}
		echo "<div class=". ($object->state == 1 ? '"moderated"':'not_moderated') . ">";
		echo html::anchor("/admin/object/$object->id/view", $object->caption );
		echo "</div>";
		$i++;
	    }

?>
        </td>
</table>
<script language="javascript" type="text/javascript">


    $().ready( function() {
        $('#all_rubrics').seavanRubricControl( {'update_url': '../../../json/rubrics', 'size': 30 }).jsonUpdate();
        $('#all_rubrics').seavanRubricControl().dblclick( function()
        {
            window.location = "edit_rubric/" + getSelectSelectedValue(this) + '/view';
        });
    });
</script>
