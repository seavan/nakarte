<? if($index % 21 == 0): ?>
</ul><ul class='list'>
<? endif; ?>
<li>
<? $char = mb_substr($item->name, 0, 1); 
   if( !isset($curchar) || ($char != $curchar)):
   		View::set_global('curchar', $char);
?>
	<span class='alphabet'><?= $char ?></span>
<?
   endif;
?>

<? if( count($item->pois) > 500 ): ?>
<a href='javascript:application.selectCity(<?= $item->id ?>)'><b><?= $item->name ?></b></a></li>
<? else: ?>
<a href='javascript:application.selectCity(<?= $item->id ?>)'><?= $item->name ?></a></li>
<? endif; ?>
