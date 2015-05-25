<!-- Страница друзей пользователя -->
<div id="container">
	<!--середина-->
	<div id="mainwrap" class="widthSite">	
		<div class="peopleBlockList">
			<h1>Друзья пользователя <a href="/u<?=$user->id?>"><?=$user->firstname?></a> <span>(<?=$friends_count?>)</span></h1>
		<? if ($friends_count > 0) {?>
			<div class="block1">
				&nbsp;
			</div>
			<div>
			<div class="block2">	
							<!--фильтр-->
				<ul class="filtr">
					&nbsp;
				</ul>
				<!--/фильтр-->			
				<form action="">
					<div class="searchBlock">
						<label for="fsearch" class="_autohide">Найти пользователя</label>
						<input type="text" value="" id="fsearch" class="inp">
						<input type="submit" value="Найти" class="but" />
					</div>
				</form>

				<!--список-->
				<div class="list">
						<?php
							NakarteHtml::FormatOrmView($friends, "widgets/user/friends_list_item", 
							array('column_count' => $column_count, 
								'view_type' => $view_type, 					  
								//'avatar' => $avatar
							));		?>

				</div>
				<!--/список-->
				<!--нумерация-->
				<ul class="pager">
					<?= $this->pagination->render(); ?>
				</ul>
				<!--/нумерация-->
			</div>
		<? } else {?>
		<h3 align=center>К сожалению, у пользователя еще нет друзей на сайте :(</h3>
		<? ;}?>
		</div>
	</div>
	<!--/середина-->
</div>
