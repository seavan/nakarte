<?
	$conf = Kohana::config('photos');
?>		
<div class='block _item'>
	<a href='/photos/id/<?= $item->id ?>' class='f'><span><img src='<?= $conf['photo_path'].$item->guid ?>.thumb.jpg' alt='' /></span></a>
	<a href="/poi/<?=$item->poi->id?>"><?= trim($item->poi->caption) ?></a>, <?= $item->poi->getKzFreeAddress() ?><br />
	<span>Рубрика:</span> <a href='#'><?= $item->poi->rubrics[0]->name ?></a><br />
	<? if ($item->user->id): ?>
	<span>Добавил:</span> <a href='/u<?=$item->user->id?>' class='user'><?= $item->user->firstname ?></a>
	<? endif; ?>
</div>