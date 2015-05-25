<?
	$view = new View('widgets/poi/places_widget');
	$view->places = $this->get_latest_places();
	$view->column_count = 1;
	$view->view_type = 'list';
	$view->show_icon = true;	
	$view->title = 'Новые <a href="places/latest">места</a>';
	$view->all_link = '<a href="places/latest" class="more">все новые места</a>';
	$view->css_class = 'newBlock';
	echo $view;	
?>
