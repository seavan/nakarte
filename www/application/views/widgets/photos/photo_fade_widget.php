<div class="coverBlock">
	<? if( count($poi->photos) == 0 ): ?>
	<img src="/static/images/pic4.jpg" alt="" width="278px"/>
	<? else: ?>
	<?
		NakarteHtml::FormatOrmView($poi->photos, "widgets/photos/photo_fade_item");
	?>
	<? endif; ?>
	<div class="descr">
		<span class="tape">&nbsp;</span>
		<a href="#photolenta" class="all"><?= count($poi->photos) ?> фото</a>
		<a href="#add_photo" class="ibutton">добавить фото</a>
	</div>
</div>
<script language='javascript' type='text/javascript'>

</script>
