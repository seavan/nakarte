<div class="photoBlockList">
	<h1><?=(isset($title))?$title:'Фотографии'?> <span>(<?= $photos_count ?>)</span></h1>
	<div class="block1">
		&nbsp;
	</div>
	<div class="block2">
		<!--фильтр-->
		<ul class="filtr">
			<? if (!isset($origin)) {
				echo new View('widgets/common/menu', array( 
				'normal_template' => '<li><span><a href="%url">%caption</a></span></li>', 
				'selected_template' => '<li class="cur"><span>%caption</span></li>', 
				'segment' => 2,
				'clear_after' => true,
				'items' => array( 
				'popular' => 'Популярные',
				'all' => 'Последние'
				) 
				)); }
			?>
		</ul>
		<!--/фильтр-->
		<!--список-->
		<?php 
			echo new View('widgets/photos/grid_photo_widget', array('photos' => $photos));
		?>					
		<!--/список-->
		<!--нумерация-->
		<ul class="pager">
			<?= $this->pagination->render(); ?>
		</ul>
		<!--/нумерация-->
	</div>
</div>
