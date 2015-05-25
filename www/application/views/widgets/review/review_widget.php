<div class="commentBlock">
	<a name="otzivlink"></a>
	<h2 class="title">Отзывы <span>(<?= count($items) ?>)</span></h2>
	<ul class="list">
		<?php NakarteHtml::FormatOrmView($items, 'widgets/review/comment_item') ?>
	</ul>
	<?php if(NakarteAuth::isLoggedIn()) { echo new View('widgets/review/add_review_widget'); } ?>
</div>
