<?
	$view = new View('widgets/poi/places_widget');
	$view->places = $this->get_popular_places();
	$view->column_count = 1;
	$view->view_type = 'list';
	$view->show_icon = true;
	$view->title = 'Самые <a href="places/popular">популярные</a>';
	$view->all_link = '<a href="places/popular" class="more">все самые популярные</a>';
	$view->css_class = 'popularBlock';
	echo $view;	
?>
