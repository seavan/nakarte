<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<font color=blue><?=html::anchor("/admin/cities", '[К списку городов]')?></font>
<hr>
<p><?=$status?></p>
<h3><?=$city->name?> (<?=$city->kzname?>)</h3>
<font color=blue><?=html::anchor("/admin/city/edit/$city->id", '[Изменить]')?></font>
<font color=blue><?=html::anchor("/admin/city/delete/$city->id", '[Удалить]',array('onclick'=>'return confirm ("Действительно удалить город?")'))?></font>
<font color=green><?=html::anchor("/admin/city/add", '[Добавить новый город]')?></font><br />
<br />
<table style="border-collapse: collapse;">
	<? foreach($city_info as $field=>$name) : ?>
		<tr style="border: 1px solid black; padding: 5px;">
			<td style="border: 1px solid black"><b><?=$name?></b></td >
			<td style="border: 1px solid black; padding: 5px;">
				<?php switch($field) {
				case ($field=='poi_count') : 
					echo $city->pois->count();
					break;
				default : 
					echo $city->$field=($city->$field)?$city->$field:'-';
				} ?>
			</td>
		</tr>
	 <?php endforeach; ?>		
 </table> 
<hr/>
<br style="clear:both"/>
