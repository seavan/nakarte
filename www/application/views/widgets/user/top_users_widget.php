<div class="userListBlock">
    <h2 class="title">Пользователи</h2>
    <!--фильтр-->
    <div class="selectfiltr" style="display:none">
		<ul class="select"> <!-- show -->
			<li><a>Лучшие за день</a></li>
			<li class="act"><a>Лучшие за неделю</a></li>
			<li><a>Лучшие за месяц</a></li>
		</ul>
    </div>
    <!--/фильтр-->
    <ul class="list">
		<?php NakarteHtml::FormatOrm($this->get_top_users(), 'OuterUser') ?>
    </ul>
    <a href="people/all" class="more">все пользователи</a>
</div>