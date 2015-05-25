<div class="placeBlockList">
	<h1><?=(isset($title))?$title:'Места'?> <span>(<?=$places_count?>)</span></h1>
	<div class="block1">
		&nbsp;
	</div>
	<div class="block2">
		<? if (!isset($hide_search) || !$hide_search) :?>
		<!--рубрики-->
		<form action="/places/<?=$this->uri->segment(2)?>" method="GET">		
			<div class="selectRubricForm">
				<select id="cat" name="cat">
					<?php
						foreach($categories as $category) {
							if ((isset($_GET['cat']) && $category->id==$_GET['cat']) || (isset($parent_category) && $category->id == $parent_category->id)) {
								echo '<option selected value="'.$category->id.'">'.$category->name.'</option>';
							}
							else
							{
								echo '<option value="'.$category->id.'">'.$category->name.'</option>';
							}
						}
					?>
				</select>
				<select id="subcat" name="subcat">
				<!-- <option value="0">---</option> -->
				<?php
						
						foreach($sub_categories as $sub_category) {
							if (isset($_GET['subcat']) && ($sub_category->id==$_GET['subcat'])) {
								echo '<option selected value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
							}
							else
							{
								echo '<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
							}
						}
					?>
				</select>
				<input type="submit" value="показать" class="ibutton" />
			</div>
		</form>
		
		<!--/рубрики-->
		<!--фильтр-->
		<ul class="filtr">
			<? 		echo new View('widgets/common/menu', array( 
						'normal_template' => '<li><span><a href="%url">%caption</a></span></li>', 
						'selected_template' => '<li class="cur"><span>%caption</span></li>', 
						'segment' => 2,
						'clear_after' => true,
						'items' => array( 
							'popular' => 'Популярные',
							'latest' => 'Последние'
										) 
							) 
						);
				
			?>
		</ul>
		<!--/фильтр-->
		<? endif; ?> <!-- if ($hide_search) -->
		<!--список-->
		<div>
			<?php 
				$view = new View('widgets/poi/places_list');
				$view->places = $places;
				$view->view_type = 'search_result';
				$view->column_count = 2;
				$view->show_rating = true;
				$view->show_rubric = true;
				$view->show_icon = false;
				$view->origin = isset($origin) && $origin;                  
				echo $view;
			?>

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
</div>