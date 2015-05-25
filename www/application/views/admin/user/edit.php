<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<font color=blue><?=html::anchor("/admin/users", '[К списку пользователей]')?></font><br />
<hr>
<font color=blue><?=html::anchor("/admin/user/view/$user->id", '[Посмотреть]')?>
<?=html::anchor("/admin/user/delete/$user->id", '[Удалить]',array('onclick'=>'return confirm ("Действительно удалить пользователя?")'))?></font>
<br />
<h3>Редактирование пользователя [ id = <?=$user->id?> ]</h3>
<?=$status?>
<? if (isset($errors)) {foreach ($errors as $error) {echo '<font color=red>'.$error.'</font><br />';} }
	$req ='<font color=red>  *</font>';?>
<table>
	<? echo form::open_multipart(); ?>
		<tr><td><?=form::hidden('id', $user->id)?></td></tr>
		<? foreach ($user_info as $field=>$name) :?>
			<tr><td><b><?=form::label($name)?></b></td>
			
			<td><?php switch($field) {
				case ('city_id') : 
					$selection = (ORM::factory('city')->select_list('id','name'));
					$selection=array(0=>'---')+$selection;
					echo form::dropdown('city_id',$selection,$user->$field,'style="width: 154px"');
					break;
				case ('status') : 
					$selection = array('confirmed' =>'подтвержденный', 'unconfirmed' => 'неподтвержденный', 
										'admin' => 'админ','banned'=>'заблокированный');
					echo form::dropdown('status',$selection,$user->$field,'style="width: 154px"');
					break;
				case ('id'):
					echo form::input($field, $user->$field,'DISABLED').$req; break;
				case ('email'):
					echo form::input($field, $user->$field).$req;
					break;
				case ('firstname'):
					echo form::input($field, $user->$field).$req;
					break;
				case ('username'):
					echo form::input($field, $user->$field).$req.'<font color=grey> если не задано, будет использоваться email</fontfont>';
					break;				
				case ('logins'):
					echo form::input($field, $user->$field,'DISABLED');
					break;
				case ('last_login'):
					echo form::input($field, date('Y-m-d H:i:s',$user->$field),'DISABLED');
					break;
				case ('mtime'):
					echo form::input($field, $user->mtime,'DISABLED');
					break;
				case ($field=='avatar_guid') :
					echo '<a target="blank" href="'.$user->avatar_url().'"><img src="'.$user->avatar_url('mid').'"></a><br />';					
					$attributes = array('name' => 'picture', 'style' => 'width:400px');
					echo form::upload($attributes, 'userdata/tmp');
					echo form::hidden('avatar_guid', $user->avatar_guid);							
					break;			
				default : 
					echo form::input($field, $user->$field);
				} ?>
				</td>
			</tr>
			<?php endforeach; ?>
		<tr><td><b><?=form::label('Пароль')?></b></td><td><?=form::password('password')?></td>		
</table>
<br />
<?=form::submit('submit', 'Сохранить')?><?=form::input(array('type'=>'reset','name'=>'reset'),"Отменить"); ?>
<?php form::close();?>
<hr/>
<br style="clear:both"/>
