<?
	if( ($index % 3) == 0 ):
?>
<div class="list">					
<?
	endif;
?>
<div class="block">
	<div class="f"><a href="<?= $item->view_url() ?>"><img src="<?= $item->thumb_url() ?>" title="<?=$item->descr?>"></a></div>
	<a href="<?=$item->poi->getViewUrl()?>"><?= trim($item->poi->caption) ?></a>, <?= $item->poi->getKzFreeAddress() ?><br />
	<span>Рубрика:</span> <a href='#'><?= $item->poi->rubrics[0]->name ?></a><br />
	<? if ($item->user->id): ?>
	<span>Добавил:</span> <a href='/u<?=$item->user->id?>' class='user'><?= $item->user->getFullName() ?></a><br />
	<? endif; ?>	
</div>
<?
	if( ($index % 3) == 2 ):
?>
</div>
<?
	endif;
?>
