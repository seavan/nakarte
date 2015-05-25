<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?=form::open(NULL, array('method'=>'get'))?>
<h3>Поиск</h3>
<fieldset>
<table>
	<tr><td><?=form::label('id')?></td><td><?=form::input('id', $this->input->get('id',''))?></td>
		
		<td align='right'>Объект <?php $selection=ORM::factory('poi')->select_list('id','caption'); 
			$selection=array(0=>'---')+$selection; ?></td>
		<td><?=form::dropdown('poi_id',$selection,$this->input->get('poi_id'),'style="width: 154px"'); ?></td>		
	</tr>
	<tr>
	<td><?=form::label('Описание')?></td><td><?=form::input('descr', $this->input->get('descr',''))?></td>			
		<td align='right'>Пользователь <?php $selection=ORM::factory('user')->select_list('id','username'); 
			$selection=array(0=>'---')+$selection; ?></td>
		<td><?=form::dropdown('user_id',$selection,$this->input->get('user_id'),'style="width: 154px"'); ?></td>			
	</tr>
	<tr>
	<td style="color: grey;">Сортировать по: <?php $selection = array('id' =>'id','user_id' =>'пользователь', 'poi_id' => 'объект',
																	'vote_avg'=>'Рейтинг','vote_count'=>'Кол-во голосов');?></td>	
		<td style="color: grey;"><?=form::dropdown('sort',$selection,$this->input->get('sort'),'style="width: 154px"')?></td>
		<td align="left"><?=form::checkbox('order', 'desc',(($this->input->get('order')=='desc')?TRUE:FALSE))?>
		<?=form::label('order','по убыванию')?></td>	
	</tr>
</table>
<?=form::submit('submit','Найти')?><? form::input(array('type'=>'reset','name'=>'reset'),"Очистить"); ?>
</fieldset>
<?php form::close();?>
<h3>Фотографии (<?=$pagination->total_items?>)</h3>
<font color=green><?=html::anchor("/admin/list_objects", '[Добавить фото к объекту]')?></font>
<p><?=$pagination?></p>

<table style="border-collapse: collapse;">
	<tr  style="border: 1px solid black; padding: 5px;">
		<? foreach($list_fields as $field=>$name): ?> 
			<th  style="border: 1px solid black; padding: 5px;"><?=$name?></th>
		<? endforeach; ?>
		<th  style="border: 1px solid black; padding: 5px;">Действия</th>
	</tr>
	<?php foreach($objects as $photo) : ?> 
		<tr  style="border: 1px solid black; padding: 5px;"><? foreach($list_fields as $field=>$name) : ?>
			<td  style="border: 1px solid black; padding: 5px;">
			<?php switch($field) {
				case ($field=='user_id') : 
					echo html::anchor("/admin/user/view/".$photo->user_id,$photo->user->email);
					break;				
				case ($field=='poi_id') : 
					echo html::anchor("/admin/object/".$photo->poi_id."/view#object_photo_tab",$photo->poi->caption);
					break;
				case ($field=='guid') : 
					echo '<a target="blank" href="'.$photo->full_url().'"><img src="'.$photo->thumb_url().'"></a>';
					break;
				case ('add_time') :
					echo date('Y-m-d H:i:s', $photo->$field); break;
				default : 
					echo $photo->$field;
				} ?>
				</td>				
			<? endforeach; ?>
			<td  style="border: 1px solid black; padding: 5px;">
				<font color='blue'><?=html::anchor("/admin/photo/view/$photo->id", 'Просмотр')?><br /><br />
				<?html::anchor("/admin/photo/edit/$photo->id", 'Редактировать')?>
				<?=html::anchor("/admin/photo/delete/$photo->id", 'Удалить',array('onclick'=>'return confirm ("Действительно удалить фото?")'))?></font>
			</td>
			
		</tr>
	<?php endforeach; ?>
</table>

<p><?php  echo $pagination ?></p>
