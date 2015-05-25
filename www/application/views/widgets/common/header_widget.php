<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div id="header" class="widthSite">
	<? if($this->uri->total_segments() == 0 ): ?>
	<span class='logo'>
    <img src="/static/i/logo.png" alt="На карте" />
    </span>
    <? else: ?>
	<a href="/" class="logo"><img src="/static/i/logo.png" alt="На карте" /></a>    
    <? endif; ?>

<!--города-->	
 	<?= new View('widgets/select_city/select_city_widget') ?>
<!--/города-->

	<!--авторизация-->
	<?php echo $this->get_auth_block(); ?>
	<!--/авторизация-->	
	
    <!--меню-->
    <ul class="menuTop">
	<li><a href="/pages/about">О проекте</a></li>
	<li><a href="/pages/help">Помощь</a></li>

<!--	<li class="tourSite"><a href="/pages/tour">тур по сайту</a></li>-->
    </ul>
    <!--/меню-->
    <!--добавить место-->
	<a href="/create_poi" class="addPlaceBlock ibutton" style='display: none'><span>добавить место</span></a>
    <!--/добавить место-->
	<?php
		if(NakarteAuth::isAdmin()) echo "<a href='/admin' style='position: absolute; right: 0'>Админка</a>";
	?>

    <!--меню поиска-->
    <?php echo $this->get_search_block() ?>
    <!--/меню поиска-->
	<!--рубрики -->
	<?php echo $this->get_rubrics_block() ?>
	<!--/рубрики -->
</div>