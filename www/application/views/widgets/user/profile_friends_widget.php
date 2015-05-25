<!--Список друзей в профиле пользователя -->
<? if (count($friends)!==0) { 				
	?>
	
	
	<?
	$view = new View('widgets/user/people_list');
	$view->view_type = 'list';
	$view->per_page = $per_page;
	$view->people = $friends;
	$view->people_count = $friends_count;
	$view->column_count = 1;
	$view->css_class = 'list';
	$view->show_name = false;
	$view->avatar_size = 'sm';
	$view->show_more_dots = true;	
	$view->origin = 'friends';	
	$view->title = '<a href="'.url::current().'/friends">Друзья </a> <span>('.$friends_count.')</span>';	
	//$view->all_link = '<a href="/places/popular" class="more">все самые популярные</a>';
	echo $view;	
?>
	 <a href="<?=url::current()?>/friends" class="more">все друзья</a>
	 </div>
	    <? ; }  
		else {
		?>
		<h2 class="title"><a href="#">Друзья </a><span>(0)</span></h2>
		<? ; } ?>
						


 						




