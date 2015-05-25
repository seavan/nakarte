<? //параметр $via означает доступ к свойствам через "lazy loading" объектов
	if (isset($origin) && $origin) {		
			if ($origin=='friends') 
			{
				$item=$item->friend; 
			}
			elseif ($origin=='poi_visitors')
			{
				$item=$item->user;
			}
	} 
?>
	
<? if ($css_class=='block') :?>
	<div class="block">
<? endif;?>
	<a href="/u<?=$item->id?>" class="name">
		<img src="<?=$item->avatar_url($avatar_size)?>" title="<?=$item->getFullName()?>" />
		<? if (isset($show_name) && $show_name) : ?>
			<?=$item->getFullName()?>
		<? endif; ?>
	</a>
	<? if (isset($show_poi)) :?>
		Объектов: <a href="#">0</a>
	<? endif; ?>
<? if ($css_class=='block'): ?>
	</div>
<? endif;?>