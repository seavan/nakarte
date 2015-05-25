<?
	$per_page=13;
	$people=$poi->get_visitors($per_page,0);
	$people_count=$poi->get_visitors()->count();	
	$view = new View('widgets/user/people_list');
	$view->view_type = 'list';
	$view->per_page = $per_page;
	$view->people = $people;
	$view->people_count = $people_count;
	$view->column_count = 1;
	$view->css_class = 'list';
	$view->show_name = false;
	$view->avatar_size = 'sm';
	$view->show_more_dots = true;	
	$view->origin = 'poi_visitors';
	$view->title = '<a href="#">Уже побывали </a> <span>('.$people_count.')</span>';	
	//$view->all_link = '<a href="/places/popular" class="more">все самые популярные</a>';
	echo $view;	
?>
<? if((NakarteAuth::isLoggedIn())): ?>
	<div class="visitedBlock" >
		<div class="listDoor"><span>я тоже здесь был</span></div>
	</div>
<? endif; ?>
</div>