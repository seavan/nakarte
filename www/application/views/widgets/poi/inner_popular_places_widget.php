<?
	$places=$poi->get_popular_places_rubric(5,0);
	$places_count=$poi->get_popular_places_rubric()->count();
	$view = new View('widgets/poi/places_widget');
	$view->places = $places;
	$view->column_count = 1;
	$view->view_type = 'list';
	$view->show_rating = true;
	$view->show_rubric = false;	
	$view->show_comments = true;
	$view->show_icon = false;                  
	$view->origin = true;
	$view->title = '<a href="/places/popular">Популярные</a> <span>('.$places_count.')</span>';
	$view->css_class = 'placeList';
	$view->all_link = '<a href="/places/popular" class="more">все самые популярные</a>';
	echo $view;	
?>
