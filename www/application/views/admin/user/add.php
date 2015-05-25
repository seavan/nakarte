<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php $req ='<font color=red>  *</font>'; ?>
	<h3>Добавление пользователя</h3>
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
		<? $hide = array('id','logins','last_login','mtime','mood'); //поля, скрываемые при вводе нового пользователя
		foreach ($user_info as $field=>$name) {
			if (!in_array($field, $hide)) :?>
			<tr><td><b><?=form::label($name)?></b></td>
			
			<td><?php switch($field) {
				case ('city_id') : 
					$selection = (ORM::factory('city')->select_list('id','name'));
					$selection=array(0=>'---')+$selection;
					echo form::dropdown('city_id',$selection,$this->input->post('city_id'),'style="width: 154px"');
					break;
				case ('status') : 
					$selection = array('confirmed' =>'подтвержденный', 'unconfirmed' => 'неподтвержденный', 
										'admin' => 'админ','banned'=>'заблокированный');
					echo form::dropdown('status',$selection,$this->input->post($field),'style="width: 154px"');
					break;				
				case ('email'):
					echo form::input($field, $this->input->post($field)).$req;
					break;
				case ('firstname'):
					echo form::input($field, $this->input->post($field)).$req;
					break;
				case ('username'):
					echo form::input($field, $this->input->post('email')).$req.'<font color=grey> если не задано, будет использоваться email</fontfont>';
					break;
				case ($field=='avatar_guid') :								
					$attributes = array('name' => 'picture', 'style' => 'width:400px');
					echo form::upload($attributes, 'userdata/tmp');
					//echo form::hidden('avatar_guid', '');
					break;												
				default : 
					echo form::input($field, $this->input->post($field));
				} ?>
				</td>
			</td></tr>
			<?php endif;
		} // endforeach
			 ?>
		<tr><td><b><?=form::label('Пароль')?></b></td><td><?=form::password('password')?><?=$req?></td>		
</table>
<br />
<?=form::submit('submit', 'Сохранить')?>
<?php form::close();?>
<hr/>
