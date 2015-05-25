<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo html::specialchars($title) ?></title>
	<script type="text/javascript" src="<?php echo url::base(FALSE) ?>/static/scripts/jquery.js"></script>
	<script type="text/javascript" src="<?php echo url::base(FALSE) ?>/static/scripts/jquery.ui.js"></script>
	<script type="text/javascript" src="<?php echo url::base(FALSE) ?>/static/scripts/jquery.ui.i18n.js"></script>
	<script type="text/javascript" src="<?php echo url::base(FALSE) ?>/static/scripts/jquery.dragndrop.js"></script>
        <script type="text/javascript" src="<?php echo url::base(FALSE) ?>/static/scripts/seavan.controls.js"></script>


        <link rel="stylesheet" type="text/css" href="/static/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="/static/css/jquery.ui.css"/>

</head>
<body>
	<h1><?php echo html::specialchars($title) ?></h1>
        <div style="margin: 2em">
	<?php echo $content ?>

	<p class="copyright">
		Страница отработана за {execution_time} seconds, с использованием {memory_usage} памяти<br />
		©2010 Нота-Медиа
	</p>
        </div>
</body>
</html>