<div class="block1">
	<!--фото-->
	<? 
		$view = new View('widgets/photos/photo_fade_widget'); 
	    $view->poi = $poi;
	    echo $view;
	?>
	<!--/фото-->
	<div>
		<!--уже побывали-->				
		
		<?php echo new View('widgets/poi/already_visited_widget',array('poi'=>$poi)) ?>
		<!--/уже побывали-->
		<!--похожие места-->
		<?php echo new View('widgets/poi/inner_related_places_widget',array('poi'=>$poi)) ?>
		<!--/похожие места-->
		<!--новые места-->
		<?php echo new View('widgets/poi/inner_new_places_widget',array('poi'=>$poi)) ?>
		<!--/новые места-->
		
	</div>
	<div>		
		<!--популярные места-->
		<?php echo new View('widgets/poi/inner_popular_places_widget',array('poi'=>$poi)) ?>
		<!--/популярные места-->
	</div>
</div>
<div class="block2">
	<div class="placeOne">
		<h1><?php echo $poi->caption ?></h1>
		<?  if($poi->hasEditPermission()): ?>
		<p style='text-align: right'><a href='/admin/object/<?= $poi->id ?>/view'>Редактировать в админке</a></p>
		<?  endif; ?>
		<!--путь-->
		<ul class="path">
			<li><a href="/">Главная</a></li>
			<li><a href="/">Места в городе</a></li>
			<? if(count($poi->rubrics)): ?>
			<li><a href="#"><?php echo $poi->rubrics[0]->rubric->name ?></a></li>
			<li class="cur"><?php echo $poi->rubrics[0]->name ?></li>
			<? endif; ?>
		</ul>
		<!--/путь-->
		<div class="personal" >
			<?= new View('widgets/poi/user_actions', array('object' => $poi)) ?>
			<div class="address">
				<?php echo $poi->address ?>
			</div>
			<div class="time">
				<!-- todo -->
				<b>
					<?php foreach($poi->attribute_values as $att)
					{
						if($att->attribute_type->caption == 'Время работы')
						{
							echo "Время работы:<br />";
							echo $att->value;
							break;
						}
					}
					?>
				</b>
			</div>

			<!-- rating - hidden -->
			<div class="ratingBlock">
				<div class="rating">
					<div><span style="width: <?= $poi->vote_css() ?>%">&nbsp;</span></div>
							<?php echo $poi->vote_count ?>
				</div>
				<a href="#otzivlink" class="comment"><span><?php echo $poi->poi_comments->count() ?> отзывов</span></a>
			</div>

		</div>
		<!-- описание -->
		<div class="txtBlock">
			<?= $poi->descr ?>
		</div>
		<!-- атрибуты -->
		<ul class="optionsList" >
			<?php foreach($poi->attribute_values as $att) echo NakarteHtml::AttributeValueItem($att) ?>
		</ul>
	</div>

	<!--фотки лента-->
	<?php
		$photo_block = new View('widgets/photos/inner_poi_photos_list');
		$photo_block->poi = $poi;
		echo $photo_block;
	?>
	<!--/фотки лента-->

	<!--отзывы-->
	<div>
		<?
			$cmnts = new NakartePoiComments($poi->id); 
			echo $cmnts->get_view();
		?>
	</div>
	<!--/отзывы-->
</div>
