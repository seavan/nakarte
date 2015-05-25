<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php $req ='<font color=red>  *</font>'; ?>
	<h3>Добавление города</h3>
<? if (isset($errors)) 
	{ 
		foreach ($errors as $error) 
		{ 
			echo '<font color=red>'.$error.'</font><br />';
		} 
	} ?>
<table>
	<? echo form::open(NULL, array('method'=>'post')); ?>		
		<tr>
			<td><b>Введите название нового города: </b></td><td><?=form::input('name', '').$req;?></td>
	</tr>
</table>
<br />
<?=form::submit('submit', 'Добавить')?>
<?php form::close();?>
<hr/>
