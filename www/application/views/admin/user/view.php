<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<font color=blue><?=html::anchor("/admin/users", '[К списку пользователей]')?></font>
<hr>
<p><?=$status?></p>
<h3>Пользователь [<?=$user->email?>]</h3>
<font color=blue><?=html::anchor("/admin/user/edit/$user->id", '[Изменить]')?></font>
<font color=blue><?=html::anchor("/admin/user/delete/$user->id", '[Удалить]',array('onclick'=>'return confirm ("Действительно удалить пользователя?")'))?></font>
<font color=green><?=html::anchor("/admin/user/add", '[Добавить нового пользователя]')?></font><br />
<br />
<table style="border-collapse: collapse;">
	<? foreach($user_info as $field=>$name) : ?>
		<tr style="border: 1px solid black; padding: 5px;">
			<td style="border: 1px solid black"><b><?=$name?></b></td >
			<td style="border: 1px solid black; padding: 5px;">
				<?php switch($field) {
				case ($field=='last_login') : 
					echo date('Y-m-d H:i:s',$user->last_login);
					break;
				case ($field=='avatar_guid') :
					echo '<a target="blank" href="'.$user->avatar_url().'"><img src="'.$user->avatar_url('mid').'"></a><br />';							
					break;			
				default : 
					echo $user->$field=($user->$field)?$user->$field:'-';
				} ?>
			</td>
		</tr>
	 <?php endforeach; ?>		
 </table> 
<hr/>
<br style="clear:both"/>
