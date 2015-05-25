<div class="addPlaceForm">
	<h1>Создание объекта</h1>
	<!--путь-->
	<ul class="path">
		<li><a href="/">Главная</a></li>
		<li class="cur" href='#'>Создание объекта</li>
	</ul>
	<!--/путь-->
	<form action="/create_poi" method="post">
		<input type="hidden" id="coords" name="coords" />
		<div class="iForms">
			<div class="iField">
				<div class="name">Город:</div>
				<div class="inp">Москва</div>
			</div>
			<div class="iField">
				<label for="fnameplace" class="name">Наименование:</label>
				<input type="text" value="" name="caption" id="fnameplace" class="inp" />
				<small><!-- hint --></small>
			</div>
			<div class="iField">
				<label for="fdescrplace" class="name">Описание:</label>
				<textarea rows="1" cols="1" id="fdescrplace" name="description"></textarea>
			</div>

			<dl class="selectRubric iField">
				<dt>Рубрики</dt>
				<dd>
					<div class="fl_l select">
						<label>Добавленные рубрики:</label>
						<select size="9" multiple=multiple class='_selectedRubrics' name='selectedRubrics'>
						</select>
						<small>Для удаления из рубрики - двойной щелчок</small>
					</div>
				    <?= new View('widgets/rubrics/rubric_list') ?>
				</dd>
			</dl>
			<div class="iField">
				<label for="faddressplace" class="name">Адрес объекта:</label>
				<input type="text" value="" id="faddressplace" class="inp" onkeydown="return monitorEnter(event, this, application.selectMapLocationEdit)" />
				<small>Введите адрес и нажмите Enter</small>
			</div>
			<div class="map _selectMap">
			</div>
			<div class="but">
				<div class="ibutton" onclick='$(this).parents("form").first().submit()'><span>добавить место</span></div>
			</div>
		</div>
	</form>
</div>
<script language='javascript' type='text/javascript'>
	$(document).ready( function()
	{
		$rubrics = $('._availableRubrics');
		$selectedRubrics = $('._selectedRubrics');
		$options = $rubrics.find('option');
		$options.unbind();
		$options.dblclick( function() { application.addRubric($selectedRubrics, $(this)); } );
	}
	);
</script>
