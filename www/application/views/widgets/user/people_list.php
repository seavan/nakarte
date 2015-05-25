<div class="peopleBlock">
<h2 class="title"><?= $title ?></h2>	
	<ul class="list">
		<?php
			NakarteHtml::FormatOrmView($people, "widgets/user/people_list_item", 
				array('column_count' => $column_count, 
					  'view_type' => $view_type,
					  'css_class'=> $css_class,
					  'avatar_size'=> $avatar_size,					  
					  'origin'=> $origin));
		?>

		<? if (isset($show_more_dots) && $show_more_dots && ($people_count>$per_page)) {?>
				<a href="<?=url::current()?>/friends" class="more">...</a>
		<? ; } ?>
	</ul>
<? if (($origin <> 'poi_visitors') && ($origin <> 'friends') ): ?>
</div>
<? endif;?>
