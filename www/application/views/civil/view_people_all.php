<div id="container">
<? //Kohana::debug($users)?>
	<!--середина-->
	<div id="mainwrap" class="widthSite">
		<div class="peopleBlockList">
			<h1><?=(isset($title))?$title:'Пользователи'?> <span>(<?=$users_count?>)</span></h1>
			<div class="block1">
				&nbsp;
			</div>
			<div class="block2">
				<!--фильтр-->
				<ul class="filtr">
					<?
						if (!isset($origin) || !$origin) {
						echo new View('widgets/common/menu', array( 
						'normal_template' => '<li><span><a href="%url">%caption</a></span></li>', 
						'selected_template' => '<li class="cur"><span>%caption</span></li>', 
						'segment' => 2,
						'clear_after' => true,
						'items' => array( 
						'all' => 'Все',
						'latest' => 'Последние'
						) 
						) 
						);
					} else {echo '&nbsp;';}
					?>
				</ul>
				<!--/фильтр-->
				<form action="/people/search">
					<div class="searchBlock">
						<label for="fsearch" class="_autohide">Найти пользователя</label>
						<input type="text" value="<?=isset($_GET['fsearch'])?$_GET['fsearch']:''?>" id="fsearch" name="fsearch" class="inp">
						<input type="submit" value="Найти" class="but" />
					</div>
				</form>

				<!--список-->				
				<div class="list">
						<?php
							NakarteHtml::FormatOrmView($users, "widgets/user/people_list_item", 
							array('column_count' => '4', 
								'view_type' => 'list', 	
								'origin' => isset($origin)&&$origin?$origin:false,
								'css_class'	=>$css_class,
								'avatar_size' => $avatar_size,
								'show_name'	=>isset($show_name)&&$show_name?$show_name:false,
								
							));		?>

				</div>
				<!--/список-->
				<!--нумерация-->
				<ul class="pager">
					<?= $this->pagination->render(); ?>
				</ul>
				<!--/нумерация-->
			</div>
		</div>
	</div>
	<!--/середина-->
</div>
