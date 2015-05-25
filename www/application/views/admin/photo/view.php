<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<font color=blue><?=html::anchor("/admin/photos", '[К списку фотографий]')?></font>
<hr>
<p><?=$status?></p>
<!--<font color=blue><?=html::anchor("/admin/photo/edit/$photo->id", '[Изменить]')?></font>-->
<font color=blue><?=html::anchor("/admin/photo/delete/$photo->id", '[Удалить]',array('onclick'=>'return confirm ("Действительно удалить фото?")'))?></font>
<br />
<br />
<table style="border-collapse: collapse;">
	<? foreach($photo_info as $field=>$name) : ?>
		<tr style="border: 1px solid black; padding: 5px;">
			<td style="border: 1px solid black"><b><?=$name?></b></td >
			<td style="border: 1px solid black; padding: 5px;">
				<?php switch($field) {
				case ($field=='guid') : 
					echo '<a target="blanc" href="../../../userdata/photo/'.$photo->guid.'.jpg">'.html::image('userdata/photo/'.$photo->guid.'.thumb.jpg').'</a>';
					break;
				case ($field=='poi_id') : 
					echo html::anchor("/admin/object/".$photo->poi_id."/view",$photo->poi->caption);
					break;
				case ($field=='user_id') : 
					echo html::anchor("/admin/user/view/".$photo->user_id,$photo->user->email);
					break;
				case ('add_time') :
					echo date('Y-m-d H:i:s', $photo->$field); break;
				case ('city_id') :
				    $poi=ORM::factory('poi',$photo->poi_id);
					echo ORM::factory('city',$poi->city_id)->name;
					break;
				default : 
					echo $photo->$field=($photo->$field)?$photo->$field:'-';
				} ?>
			</td>
		</tr>
	 <?php endforeach; ?>		
 </table> 
<hr/>
<br style="clear:both"/>
