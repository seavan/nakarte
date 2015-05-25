<!--Список фото в профиле пользователя -->
<? if (count($photos)!==0) { 				
	?>
	<h2 class="title"><a href="<?=url::current()?>/photos">Фото</a> <span>(<?=$photo_count?>)</span></h2>
	<div class="list">
			<?
			foreach ($photos as $item) { ?>
			
			<a href='<?=$item->view_url()?>'><img title="<?=$item->descr?>" src='<?=$item->thumb_url()?>'></a>			
			<? ; }?>
			<? if ($photo_count>$per_page) {?>
			<a href="<?=url::current()?>/photos" class="more">...</a>
			<? ; } ?>
		</div>
	<a href="<?=url::current()?>/photos" class="more">все фото</a>
	    <? ; }  
		else {
		?>
		<h2 class="title"><a href="#">Фото </a><span>(0)</span></h2>
		<? ; } ?>
						


 						




