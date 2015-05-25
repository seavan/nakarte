<?	$places=$poi->get_related_places_rubric(5,0);
	$places_count=$poi->get_related_places_rubric()->count();		
	
	$view = new View('widgets/poi/places_widget');
	$view->places = $places;
	$view->column_count = 1;
	$view->view_type = 'list';
	$view->show_rating = true;
	$view->show_rubric = false;	
	$view->show_comments = true;
	$view->show_icon = false;                  
	$view->origin = true;
	$view->title = '<a href="/poi/'.$poi->id.'/related">Похожие места</a> <span>('.$places_count.')</span>';
	$view->css_class = 'placeList';
	$view->all_link = '<a href="/poi/'.$poi->id.'/related" class="more">все похожие места</a>';
	echo $view;		
?>