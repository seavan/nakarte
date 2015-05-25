<!DOCTYPE html>
<html>
    <head>
		<title>На карте</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="Keywords" content="" />
		<meta name="Description" content="" />
		<link rel="shortcut icon" href="/static/css/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="/static/css/main.nakarte.css" />
		<link rel="stylesheet" type="text/css" href="/static/css/js.nakarte.css" />
		<script type="text/javascript" src="/static/scripts/jquery.js"></script>
		<script type="text/javascript" src="/static/scripts/jquery.ui.js"></script>
		<script type="text/javascript" src="/static/scripts/jquery.ui.i18n.js"></script>
		<script type="text/javascript" src="/static/scripts/jquery.dragndrop.js"></script>
		<script type="text/javascript" src="/static/scripts/jquery.cookie.js"></script>				
		<script type="text/javascript" src="/static/scripts/seavan.nakarte.js"></script>
		<script type="text/javascript" src="/static/scripts/yandex.nakarte.js"></script>
		<script type="text/javascript" src="/static/scripts/application.nakarte.js"></script>
		<script type="text/javascript" src="/static/scripts/slideshow.js"></script>		
		<script src="http://api-maps.yandex.ru/1.1/index.xml?key=<?php echo $this->get_yakey() ?>"
		type="text/javascript"></script>
    </head>
    <body>
		<div id="container">
			<!--шапка-->
			<?php echo $this->get_header_block() ?>
			<!--/шапка-->
			<!--карта-->
			<?php echo $this->get_map_block() ?>
			<!--/карта-->
			<!--середина-->
			<div id="mainwrap" class="widthSite">
				<?php echo $this->get_main_block() ?>
			</div>
			<!--/середина-->
		</div>
		<!---подвал-->
		<?php echo $this->get_footer_block() ?>
		<!---/подвал-->
    </body>
</html>