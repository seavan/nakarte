<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php $req ='<font color=red>  *</font>'; ?>
	<h3>Добавление фотографии</h3>	
<? if (isset($errors)) 
	{ 
		foreach ($errors as $error) 
		{ 
			echo '<font color=red>'.$error.'</font><br />';
		} 
	} ?>
<table>
	<? echo form::open_multipart(); ?>
		<tr><td><?=form::hidden('id')?></td></tr>
		<? $hide = array('id'); //поля, скрываемые при вводе нового фото
		foreach ($photo_info as $field=>$name) {
			if (!in_array($field, $hide)) :?>
			<tr><td><b><?=form::label($name)?></b></td>			   
			
			<td><?php switch($field) {
				case ('user_id') :
					$selection = (ORM::factory('user')->select_list('id','username'));					
					$user=$this->input->post('user_id')?$this->input->post('user_id'):$this->get_user()->id;
					echo form::dropdown('user_id',$selection,$cur_user,'style="width: 154px"');
					break;
				case ('poi_id') :
					//$selection = (ORM::factory('poi')->where('city_id',$poi->city_id)->find_all()->select_list('id','caption'));
					//echo form::dropdown('poi_id',$selection,$poi_id,'style="width: 154px"').$poi_id;
					echo $poi->caption;
					echo form::hidden('poi_id', $poi->id);
					break;
				case ('city_id') :
					//$selection = (ORM::factory('city')->select_list('id','name'));
					//echo form::dropdown('city_id',$selection,$poi->city_id,'style="width: 154px"','DISABLED').'ТУТ ПЕРЕДЕЛАТЬ ВЫБОР';
					echo ORM::factory('city',$poi->city_id)->name;
					break;
				case ($field=='guid') :					
					//echo form::upload('picture');
					$attributes = array('name' => 'picture', 'style' => 'width:400px');
					echo form::upload($attributes, 'userdata/tmp');
					echo form::hidden('guid', '0');
					break;
				case ('add_time') :
				    $dt=getdate();
					echo form::input($field, date('Y-m-d H:i:s', $dt['0'])); break;				
				default : 
					echo form::input($field, $this->input->post($field));
				} ?>
				</td>
			</tr>
			<?php endif;
		} // endforeach
			 ?>
		
</table>
	
<br />
<?=form::submit('submit', 'Сохранить')?>
<?php form::close();?>
<hr/>
