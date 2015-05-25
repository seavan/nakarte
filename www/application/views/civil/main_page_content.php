<div class="block1">
	<!--пользователи-->
	<?php echo new View('widgets/user/top_users_widget'); ?>
	<!--/пользователи-->
</div>
<div class="block2">
	<!---->
	<div class="placeBlock">
		<!--новые места-->
		<?php echo new View('widgets/poi/new_places_widget'); ?>
		<!--/новые места-->
		<!--популярные места-->
		<?php echo new View('widgets/poi/popular_places_widget'); ?>
		<!--/популярные места-->
	</div>
	<!--фотографии-->
	<?php $photo_block = new View('widgets/photos/latest_photo_widget');
		$photo_block->photos = $photos;
		echo $photo_block;
	?>
	<!--/фотографии-->

</div>