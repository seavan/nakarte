<?
	$view = new View('widgets/photos/photo_widget');
	$view->upload_enabled = true;
	$view->require_auth = true;
	$view->photos = $poi->photos;
	$view->poi = $poi;
	$view->title = 'Фотографии';
	echo $view;
?>