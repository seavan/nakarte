<div class="selectCity _citySelect">
	<div class="cityDoor _select"> <!-- show -->
		<span class='act'>
			<?= $this->get_current_city()->name ?>
		</span>
	</div>			
	<div class="city"> <!-- добавляем show -->
		<div title="Закрыть" class="close" onclick='$(this).parent().fadeOut()'>Закрыть</div>
		<h2>Выберите ваш город:</h2>
		<ul class='list'>
			<?
				NakarteHtml::FormatOrmView($this->get_cities(), "widgets/select_city/select_city_item");	
			?>
		</ul>
	</div>
</div>
