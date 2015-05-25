<!--Список мест в профиле пользователя -->
<? if ($places_count!==0) { 				
	?>
	<h2 class="title">
		<a href="/<?=url::current().'/'.$type?>_places">
		<?=($type=='favorite')?'Любимые места':'Побывал'?></a> <span>(<?=$places_count?>)</span>
	</h2>	
	<ul class="list">
			<?
			foreach ($places as $item) { 
				//$item = $item->poi;												
				echo new View('widgets/poi/place_list_item', array('item' => $item,'view_type'=>'list','show_rubric'=>false,
																	'show_rating'=>true,'show_comments'=>true,'origin'=>true));	    
			}  ?>
	    <? if ($places_count > $per_page) {?>
			<!--  <a href="<?=url::current().'/'.$type?>_places" class="more">...</a><br /> -->			
		<? ; } ?>
		</ul>
			<a href="<?=url::current().'/'.$type?>_places" class="more">все места</a>
	    
		<? } else {
		?>
		<h2 class="title"><a href="#"><?=($type=='favorite')?'Любимые места':'Побывал'?> </a><span>(0)</span></h2>
		<? ; } ?>
						


 						




