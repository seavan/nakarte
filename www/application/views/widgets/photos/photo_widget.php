<div class="newPhotoBlock _slideshow">
	<h2 class="title" id="photolenta"><?= isset($title)?$title:'' ?>
		<span>(<?= count($photos) ?>)</span>
	</h2>

	<? if (isset($upload_enabled)): ?>
		<a href="javascript:;" name='add_photo' class="ibutton" onclick='$(this).next().slideToggle()'>добавить фото</a>
		<div class="_photo_upload" style="clear: both; margin-bottom: 2em; display: none;">		
			<? if(isset($require_auth) && (!NakarteAuth::isLoggedIn())): ?>
				<p>Выполните вход для того, чтобы добавить фотографии.</p>
				<? else: ?>
				<? if (isset($poi) ): ?>    
					<form enctype="multipart/form-data" action="/photos/upload" method="post">
						<input name="poi_id" type="hidden" value="<?=$poi->id?>" />
						<input name="picture" type="file" />
						<input type="submit" value="Загрузить" />
					</form>
					<? endif; ?>
			<?= new View('widgets/common/error_widget') ?>		
			<? endif; ?>
		</div>					
		<? endif;?>

	<? if (isset($filter_enabled) && $filter_enabled): ?>
		<!--фильтр-->
		<div class="selectfiltr">
			<ul class="select"> <!-- show -->
				<li><a href="#">Лучшие за день</a></li>
				<li class="act"><a href="#">Во всех рубриках</a></li>
				<li><a href="#">Лучшие за месяц</a></li>
			</ul>
		</div>
		<!--/фильтр-->
		<? endif; ?>

	<!--фотки лента-->
	<? if(count($photos)): ?>
		<div class="photoList">
			<ul class="slide _pager">
			</ul>
			<div title="Вперед" class="next hidenext _next">&nbsp;</div> <!-- hidenext -->
			<div title="Назад" class="prev hideprev _prev">&nbsp;</div>
			<div class="lentaWrap _lentaWrap">
				<div class="lenta _lenta">
					<?php 
						$view = new View('widgets/photos/photos_list');
						$view->photos = $photos;
						echo $view;
					?>	
				</div>
			</div>
		</div>
		<? endif; ?>
	<!--/фотки лента-->
	<? if (isset( $show_all ) && ($show_all) ): ?>
		<a href="/photos/all" class="more">все фотографии</a>
		<? endif; ?>
</div>