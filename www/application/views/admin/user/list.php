<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?=form::open(NULL, array('method'=>'get'))?>
<h3>Поиск</h3>
<fieldset>
<table>
	<tr><td align='right'><?=form::label('Id')?></td><td><?=form::input('id', $this->input->get('id',''))?></td>
		<td align='right'><?=form::label('Имя')?></td><td><?=form::input('firstname', $this->input->get('firstname',''))?></td>
		<td align='right'>Город <?php $selection=ORM::factory('city')->select_list('id','name'); 
			$selection=array(0=>'---')+$selection; ?></td>
		<td><?=form::dropdown('city_id',$selection,$this->input->get('city_id'),'style="width: 154px"'); ?></td>
	</tr>
	<tr>
		<td align='right'><?=form::label('Email')?></td><td><?=form::input('email', $this->input->get('email',''))?></td>				
		<td align='right'><?=form::label('Фамилия')?></td><td><?=form::input('lastname', $this->input->get('lastname',''))?></td>
		<td align='right'><?=form::label('ICQ')?></td><td><?=form::input('icq', $this->input->get('icq',''))?></td>
	</tr>
	<tr>
		<td align='right'><?=form::label('username')?></td><td><?=form::input('username', $this->input->get('username',''))?></td>		
		
		<td align='right'>Статус<?php $selection = array('confirmed' =>'подтвержденный', 'unconfirmed' => 'неподтвержденный', 
											'admin' => 'админ','banned'=>'заблокированный'); 
			$selection=array(0=>'---')+$selection;?></td>
		<td><?=form::dropdown('status',$selection,$this->input->get('status'),'style="width: 154px"')?></td>
		<td  align='right' style="color: grey;">Сортировать&nbsp;по: <?php $selection = array('id' =>'id','email' =>'email', 'username' => 'username', 'firstname' => 'имя',
													'lastname'=>'фамилия','city_id' =>'город', 'status' =>'статус');?></td>
		<td style="color: grey;"><?=form::dropdown('sort',$selection,$this->input->get('sort'),'style="width: 154px"')?><br />
		<?=form::checkbox('order', 'desc',(($this->input->get('order')=='desc')?1:0))?><?=form::label('order', 'по убыванию');?></td>
	</tr>	
</table>
<?=form::submit('submit','Найти')?><? form::input(array('type'=>'reset','name'=>'reset'),"Очистить"); ?>
</fieldset>
<?php form::close();?>
<h3>Пользователи (<?=$pagination->total_items?>)</h3>
<p><font color=green><?=html::anchor("/admin/user/add", '[Добавить нового пользователя]')?></font></p>
<p><?=$pagination?></p>

<table style="border-collapse: collapse;">
	<tr  style="border: 1px solid black; padding: 5px;">
		<? foreach($list_fields as $field=>$name): ?> 
			<th  style="border: 1px solid black; padding: 5px;"><?=$name?></th>
		<? endforeach; ?>
		<th  style="border: 1px solid black; padding: 5px;">Действия</th>
	</tr>
	<?php foreach($objects as $user) : ?> 
		<tr  style="border: 1px solid black; padding: 5px;"><? foreach($list_fields as $field=>$name) : ?>
			<td  style="border: 1px solid black; padding: 5px;">
			<?php switch($field) {
				case ($field=='email') : 
					//тут можно ссылку на профиль юзера на сайте
					echo html::anchor("/admin/user/view/".$user->id,$user->$field);
					break;
				case ($field=='city_id') : 
					echo $user->city->name;
					break;
				case ($field=='avatar_guid') : 
					echo '<img src="'.$user->avatar_url('sm').'"></a>';
					break;
				default : 
					echo $user->$field;
				} ?>
				</td>				
			<? endforeach; ?>
			<td  style="border: 1px solid black; padding: 5px;">
				<font color='blue'><?=html::anchor("/admin/user/view/$user->id", 'Просмотр')?><br />			
				<?=html::anchor("/admin/user/edit/$user->id", 'Редактировать')?>
				<?=html::anchor("/admin/user/edit/$user->id", 'Удалить',array('onclick'=>'return confirm ("Действительно удалить пользователя")'))?></font>
				
			</td>
			
		</tr>
	<?php endforeach; ?>
</table>

<p><?php  echo $pagination ?></p>
