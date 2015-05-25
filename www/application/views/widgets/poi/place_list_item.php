<? //параметр означает доступ к свойствам через "lazy loading" объектов - используется при построении списка мест пользователя
	if (isset($origin) && $origin) {$item=$item->poi;} ?>
<? if($view_type == 'search_result'): ?>
	<? if( $index % $column_count == 0): ?>
		<div class="list">
			<? endif; ?>
		<dl class="block">
			<dt><a href="<?= $item->getViewUrl() ?>"><?= $item->caption ?></a></dt>
			<dd>
				<div class="num"><?= $index + 1 ?>.</div>
				<div class="general_cont">
					<div class="rating">
						<div><span style="width: <?= floor($item->vote_avg * 20) ?>%">&nbsp;</span></div>
						<span class="value"><?= $item->vote_count ?></span>
					</div>
					<a href="<?= $item->getViewUrl() ?>#otzivlink" class="comment"><?= count($item->poi_comments) ?></a>
				</div>
				<?= $item->getKzFreeAddress() ?><br>
				<? if( count($item->rubrics) ): ?>
					<span>Рубрика:</span> <? NakarteHtml::FormatOrmView($item->rubrics, 'widgets/rubrics/rubric_href') ?></a><br>
					<? endif; ?>
				<!--			<span>Добавил:</span> <a href="#" class="user">Василий Карамурзиев</a>	-->
			</dd>
		</dl>
		<? if( $index % $column_count == 1 ): ?>
		</div>
		<? endif; ?>

	<? elseif($view_type == 'list'): ?>
	<li class="<? if( isset($show_icon) && $show_icon && count($item->rubrics)) echo $item->rubrics[0]->class ?>">
		<a href="<?= $item->getViewUrl() ?>" class="name"><?= $item->caption ?></a>
		<?= $item->getKzFreeAddress() ?><br>
		<? if( isset($show_rating) && $show_rating ): ?>
			<div class="rating">
				<div><span style="width: <?= floor($item->vote_avg * 20) ?>%">&nbsp;</span></div>
				<span class="value"><?= $item->vote_count ?></span>
			</div>
		<? endif; ?>
		<? if( isset($show_comments) && $show_comments ): ?>
			<? if (count($item->poi_comments)>0) : ?>
				<a href="<?= $item->getViewUrl() ?>#otzivlink" class="comment"><?= count($item->poi_comments) ?></a>
			<? endif;?>
			<br>
		<? endif; ?>
		<? if( $show_rubric ): ?>
			<? if( count($item->rubrics) ): ?>
				<span>Рубрика:</span> <a href="#"><?= $item->rubrics[0]->name ?></a><br>			
			<? endif; ?>
		<? endif; ?>
		<? if( $item->user->id ): ?>			
			<span>Добавил:</span> <a href="#" class="user"><?= $item->user->getFullName() ?></a>
			<? endif; ?>	
	</li>
	<? endif; ?>