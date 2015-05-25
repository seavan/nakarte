<? if($view_type == 'search_result'): ?>
<div class="placeBlockList">
<? endif; ?>
	<ul class="list">
		<?php
			NakarteHtml::FormatOrmView($places, "widgets/poi/place_list_item", 
				array('column_count' => $column_count, 
					  'view_type' => $view_type, 
					  'show_rating' => $show_rating, 
					  'show_rubric' => $show_rubric,
					  'show_icon' => $show_icon,
					  'show_comments' => isset($show_comments) && $show_comments,
					  'origin'=>isset($origin) && $origin));
		?>
	</ul>
	
<? if($view_type == 'search_result'): ?>
</div>
<? endif; ?>	
