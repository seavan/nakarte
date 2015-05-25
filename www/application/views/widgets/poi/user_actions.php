<? if(NakarteAuth::hasOwnerPermission(NakarteAuth::getUser())): ?>
<ul class="actionUser">
	<li class="favorites" onclick="application.addToFavorites($(this))" rel='<?= $poi->id ?>'><span>в избранное</span></li>
	<li class="mesfriend" onclick="application.showMessageBox($(this))" rel='<?= $poi->id ?>'><span>отправить другу</span></li>
	<li class="visitedBlock" onclick="application.beenHere($(this))" rel='<?= $poi->id ?>'><div class='listDoor'><span>я здесь был</span></div></li>
	<li class="meserror"onclick="application.objectMistake($(this))" rel='<?= $poi->id ?>'><span>сообщить об ошибке</span></li>
</ul>
<? else: ?>
<p>Для того чтобы сделать с объектом что-нибудь хорошее, Вам нужно залогиниться.</p>
<? endif; ?>

<script language="javascript" type='text/javascript'>

application.addToFavorites = function($_obj)
{
	$rel = $_obj.attr('rel');
	$.ajax(
	{
		url: '/user/add_to_favorites',
		type: 'POST',
		data:
		{
			'object_id': $rel,
		}
		
	});
	
}

</script>