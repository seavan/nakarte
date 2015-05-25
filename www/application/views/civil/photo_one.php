<div class="photoBlockOne">
	<h1><?= $photo->descr ?></h1>
  	<!---->
	<div class="photoOne">
		<?
		$ch_photo = $photo->chainPhoto(-1);
		if($ch_photo): 
		?>		
		<a href="<?= $ch_photo->view_url() ?>" class="prev">
			<span><img src="<?= $ch_photo->thumb_url() ?>" alt="" /></span>
			<dfn><?= $ch_photo->descr ?></dfn>
		</a>
		<?
	        endif;			
		?>

		<div class="cur">
			<a href='<?= $photo->full_url() ?>'><img src='<?= $photo->full_url() ?>' alt="" style='width:100%'/></a>

			<div class="descr">
				<?= $photo->poi->getHref() ?>, <?= $photo->poi->getKzFreeAddress() ?><br />
				<span>Рубрика:</span> <?= NakarteHtml::FormatOrmView($photo->poi->rubrics, 'widgets/rubrics/rubric_href') ?><br />
				<? if($photo->user_id): ?>
				<span>Добавил:</span> <a href="/u<?=$photo->user->id?>" class="user"><?= $photo->user->getFullName() ?></a><br />
				<? endif; ?>
				<? if($photo->add_time): ?>
				<span>Дата:</span> <?=$photo->showAddTime()?>
				<? endif; ?>	
				<div class="rating">
					<div><span style="width:<?= $photo->vote_css() ?>%">&nbsp;</span></div>
					<span class="value"><?= $photo->vote_count ?></span>
				</div>					
			</div>

		</div>
		<?
		$ch_photo = $photo->chainPhoto(1);
		if($ch_photo): 
		?>		
		<a href="<?= $ch_photo->view_url() ?>" class="next">
			<span><img src="<?= $ch_photo->thumb_url() ?>" alt="" /></span>
			<dfn><?= $ch_photo->descr ?></dfn>
		</a>
		<?
	        endif;			
		?>
	</div>
	<!--/-->
	<?
		$comments = new NakartePhotoComments($photo->id);
		echo $comments->get_view();          				
	?>
</div>


