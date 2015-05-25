<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?=form::open(NULL, array('method'=>'get'))?>
<h3>Поиск</h3>
<fieldset>
<!--Найти:
<input type="text" name="name" id="name" />

<script type="text/javascript">

	$('#name').autocomplete(
			'/ajax/autocities/',
			{'max': 10,
			'multiple': false,
			'dataType': 'text',
			'cacheLength': 1,
			'matchSubset': false})
	.result(function(event, item) {
				name = item[0];
				id = item[1];
				document.location.href = '/admin/city/' + id;
	});

</script>-->
<table>
	<tr><td><?=form::label('id')?></td><td><?=form::input('id', $this->input->get('id',''))?></td>
		<td><?=form::label('Название')?></td><td><?=form::input('name', $this->input->get('name',''))?></td>		
		<td><?=form::label('Название (каз.)')?></td><td><?=form::input('kzname', $this->input->get('kzname',''))?></td>			
	</tr>
	<tr>
	<td style="color: grey;">Сортировать по: <?php $selection = array('id' =>'id','name' =>'название', 'kzname' => 'название (каз.)',
																	'poi_count'=>'Кол-во объектов');?></td>	
		<td style="color: grey;"><?=form::dropdown('sort',$selection,$this->input->get('sort'),'style="width: 154px"')?></td>
		<td align="right"><p><?=form::checkbox('order', 'desc',(($this->input->get('order')=='desc')?TRUE:FALSE))?><?=form::label('order','по убыванию')?></p></td>
	</tr>	
</table>
<?=form::submit('submit','Найти')?><? form::input(array('type'=>'reset','name'=>'reset'),"Очистить"); ?>
</fieldset>

<?php form::close();?>
<h3>Города (<?=$pagination->total_items?>)</h3>
<p><font color=green><?=html::anchor("/admin/city/add", '[Добавить новый город]')?></font></p>
<p><?=$pagination?></p>

<table style="border-collapse: collapse;">
	<tr  style="border: 1px solid black; padding: 5px;">
		<? foreach($list_fields as $field=>$name): ?> 
			<th  style="border: 1px solid black; padding: 5px;"><?=$name?></th>
		<? endforeach; ?>
		<th  style="border: 1px solid black; padding: 5px;">Действия</th>
	</tr>
	<?php foreach($objects as $city) : ?> 
		<tr  style="border: 1px solid black; padding: 5px;"><? foreach($list_fields as $field=>$name) : ?>
			<td  style="border: 1px solid black; padding: 5px;">
			<?php switch($field) {
				case ($field=='email') : 
					//тут можно ссылку на профиль юзера на сайте
					echo html::anchor("/admin/city/view/".$city->id,$city->$field);
					break;				
				case ($field=='poi_count' && $city->poi_count >0) :
					//тут можно ссылку на профиль юзера на сайте
					echo html::anchor("/admin/list_objects_city/".$city->id, $city->poi_count );
					break;
				    default :
					echo $city->$field;
				} ?>
				</td>				
			<? endforeach; ?>
			<td  style="border: 1px solid black; padding: 5px;">
				<font color='blue'><?=html::anchor("/admin/city/view/$city->id", 'Просмотр')?><br />			
				<?=html::anchor("/admin/city/edit/$city->id", 'Редактировать')?><br />
				<?=html::anchor("/admin/city/delete/$city->id", 'Удалить',array('onclick'=>'return confirm ("Действительно удалить город?")'))?></font></font>
			</td>
			
		</tr>
	<?php endforeach; ?>
</table>

<p><?php  echo $pagination ?></p>
