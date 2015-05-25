<?	$places=$poi->get_latest_places_rubric(5,0);
	$places_count=$poi->get_latest_places_rubric()->count();	
	$new_places_count=$poi->count_new_places_rubric();
	$new_places_count=empty($new_places_count)?'':'+'.$new_places_count;
	
	$view = new View('widgets/poi/places_widget');
	$view->places = $places;
	$view->column_count = 1;
	$view->view_type = 'list';
	$view->show_rating = true;
	$view->show_rubric = false;	
	$view->show_comments = true;
	$view->show_icon = false;                  
	$view->origin = true;
	$view->title = '<a href="/places/latest">Новые места</a> <span  class="new">'.$new_places_count.'</span>';
	$view->css_class = 'placeList';
	$view->all_link = '<a href="/places/latest" class="more">все новые места</a>';
	echo $view;	
?>