<div class="<?= $css_class ?>">
    <h2 class="title"><?= $title ?></h2>
    <!--фильтр-->
    <div class="selectfiltr"  style="display:none">
	<ul class="select"> <!-- show -->
	    <li><a href="#">Лучшие за день</a></li>
	    <li class="act"><a href="#">Во всех рубриках</a></li>
	    <li><a href="#">Лучшие за месяц</a></li>
	</ul>
    </div>
    <!--/фильтр-->
    <?php 
	$view = new View('widgets/poi/places_list');
	$view->places = $places;
	$view->column_count = $column_count;
	$view->view_type = $view_type;
	$view->show_rating = isset($show_rating) && $show_rating;
	$view->show_rubric = isset($show_rubric) && $show_rubric;
	$view->show_comments = isset($show_comments) && $show_comments;
	$view->show_icon = isset($show_icon) && $show_icon;
	$view->origin = isset($origin) && $origin;
	echo $view;
    ?>
    <? if( isset($all_link) ): ?>
    <?= $all_link ?>
    <? endif; ?>
</div>