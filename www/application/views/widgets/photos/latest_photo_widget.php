<?
	$view = new View('widgets/photos/photo_widget');
	$view->photos = $photos;
	$view->title = 'Последние <a href="/photos/all">фото</a>';
	$view->show_all = true;
	echo $view;
?>