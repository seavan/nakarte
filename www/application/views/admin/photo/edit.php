<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<font color=blue><?=html::anchor("/admin/photos", '[К списку фотографий]')?></font><br />
<hr>
<font color=blue><?=html::anchor("/admin/photo/view/$photo->id", '[Посмотреть]')?><?=html::anchor("/admin/photo/delete/$photo->id", '[Удалить]')?></font>
<br />
<h3>Редактирование фото [ id = <?=$photo->id?> ]</h3>
<?=$status?>
<? if (isset($errors)) {foreach ($errors as $error) {echo '<font color=red>'.$error.'</font><br />';} }
	$req ='<font color=red>  *</font>';?>	
<table>
	<? echo form::open_multipart();?>
		<tr><td><?=form::hidden('id', $photo->id)?></td></tr>
		<? foreach ($photo_info as $field=>$name) :?>
			<tr><td><b><?=form::label($name)?></b></td>
			    <?php $poi=ORM::factory('poi',$photo->poi_id);?>
			
			<td><?php switch($field) {
				case ('id'):
					echo form::input($field, $photo->$field,'DISABLED').$req; break;
				case ('user_id') : 
					$selection = (ORM::factory('user')->select_list('id','username'));
					$selection=array(0=>'---')+$selection;
					echo form::dropdown('user_id',$selection,$photo->$field,'style="width: 154px"');
					break;
				case ('poi_id') :
					//$selection = (ORM::factory('poi')->where('city_id',$poi->city_id)->find_all()->select_list('id','caption'));
					//echo form::dropdown('poi_id',$selection,$photo->$field,'style="width: 154px"');
					echo $poi->caption;
					echo form::hidden('poi_id', $poi->id);
					break;
				case ('city_id') : 
					//$selection = (ORM::factory('city')->select_list('id','name'));
					//echo form::dropdown('city_id',$selection,$poi->city_id,'style="width: 154px"').'ТУТ ПЕРЕДЕЛАТЬ ВЫБОР';
					echo ORM::factory('city',$poi->city_id)->name;
					break;
				case ($field=='guid') :
					echo '<a target="blank" href="'.$photo->full_url().'"><img src="'.$photo->thumb_url().'"></a><br />';					
					$attributes = array('name' => 'picture', 'style' => 'width:400px');
					echo form::upload($attributes, 'userdata/tmp');
					echo form::hidden('guid', $photo->guid);		
					break;				
				case ('add_time') :
					echo form::input($field, date('Y-m-d H:i:s', $photo->$field)); break;
				case ('vote_avg') : 
					echo form::input($field, $photo->$field); break;
				case ('vote_count') : 
					echo form::input($field, $photo->$field); break;				
				default : 
					echo form::input($field, $photo->$field);
				} ?>
				</td>
			</tr>
			<?php endforeach; ?>
				
</table>
<br />
<?=form::submit('submit', 'Сохранить')?><?=form::input(array('type'=>'reset','name'=>'reset'),"Отменить"); ?>
<?php form::close();?>
<hr/>
<br style="clear:both"/>
