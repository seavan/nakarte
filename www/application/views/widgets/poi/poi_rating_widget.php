<div class="general_cont">
	<div class="rating">
		<div><span style="width: <?= floor($item->vote_avg * 20) ?>%">&nbsp;</span></div>
		<span class="value"><?= $item->vote_count ?></span>
	</div>
	<a href="#" class="comment"><?= count($item->poi_comments) ?></a>
</div>