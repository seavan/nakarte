<div class="rubricsMap _rubrics ">
	<dl class="_rubricDl searchResult">
		<dt class="hide">
			<span class="_rubricTitle">Рубрикатор</span>
			<span class="link" onclick="$(this).children('span').toggle(); $(this).parents('._rubrics').find('.showRubric').slideToggle()"><span style="display: block">скрыть</span><span style="display: none">показать</span></span>
		</dt>
		<dd class="showRubric" style="display: block;">
			<!-- width open = 236px, width close = 224px -->
			<div class="lentaWrap _rubricWrap">
				<div class="lenta">
					<div class="block">
						<ul class="rubricList _rubricSlider">
							<?php NakarteHtml::FormatOrm($this->get_parent_rubrics(), 'RubricWidgetParentItem') ?>
						</ul>
					</div>
					<div class="block">
						<div class="titleRubric _titleRubric">
							<div class="bg"><span>&nbsp;</span></div>
							<label for="rCarsAll"><input type="checkbox" value="" id="rCarsAll" class="_mainCheckBox"><span class="_titleRubricText"></span></label>
						</div>
						<ul class="subRubricList _subRubricList">
						</ul>
					</div>
				</div>
			</div>
		</dd>
		<dd class="showResult" style="display: none">
			<div class="statistResult">Найдено <b>28</b> объектов</div>
			<ul class="list">
				<li>
					<span class="num">1.</span>
					<a href="#" class="name">Кафе «На посошок»</a>
							Андалузская ул., д.15, стр.2
					<div class="general_cont">
						<div class="rating">
							<div><span style="width:50%">&nbsp;</span></div>
							<span class="value">525</span>
						</div>
						<a href="#" class="comment">25</a>
					</div>
				</li>
				<li>
					<span class="num">2.</span>
					<a href="#" class="name">Ресторан «Будем здоровы!»</a>
							Проспект Бекмамбекова, д.3
					<div class="general_cont">
						<div class="rating">
							<div><span style="width:50%">&nbsp;</span></div>
							<span class="value">525</span>
						</div>
						<a href="#" class="comment">25</a>
					</div>
				</li>
				<li>
					<span class="num">3.</span>
					<a href="#" class="name">Кафе «Экипаж</a>
							Приграничная ул., д.12
					<div class="general_cont">
						<div class="rating">
							<div><span style="width:50%">&nbsp;</span></div>
							<span class="value">525</span>
						</div>
						<a href="#" class="comment">25</a>
					</div>
				</li>
			</ul>
			<ul class="pager">
				<li><b>1</b></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">...</a></li>
			</ul>
			<!--поиск-->
			<form action="">
				<div class="searchBlock">
					<label for="fsearch" class="_autohide">новый поиск</label>
					<input type="text" value="" id="fsearch" class="inp">
					<input type="submit" value="Найти" class="but">
				</div>
			</form>
			<!--/поиск-->
		</dd>
	</dl>

</div>
<script language="javascript" type="text/javascript">

	$('._rubricSlider li').click(
	application.showSubRubrics
);
	$('._rubricTitle').click( function()
	{
		$this = $(this);
		if($this.hasClass('back'))
		{
			$this.removeClass('back');
			application.hideSubRubrics();
		}
	});

	var $rubricSlider = $('._rubricSlider');
	var $titleRubricText = $('._titleRubricText');
	var $subRubricList = $('._subRubricList');
	var $rubricDl = $('._rubricDl');
	var $mainCheckBox = $('._mainCheckBox');

	$subRubricList.jsonControl(
	{
		'getUpdateUrl' : function(obj)
		{
			return '/json/get_child_rubrics/' + $(obj).attr('rel');
		},
		'populateItem' : function(obj, data, item)
		{
			return $('<li class="' + data['class'] + '"><label for="r' + data.id
				+ '"><input type="checkbox" value="" rel="' + data.id + '" id="r' + data.id + '">' + data.name + '</label></li>');
		},
		'rebind' : function(obj)
		{
			$(obj).parent().find('input[type=checkbox]').attr('checked', null);
			$(obj).find('li').addClass('hide');
			$(obj).find('input[type=checkbox]').click( function() { $(this).parents('li').first().toggleClass('hide'); application.mapSearchRubrics($subRubricList); });
			application.mapSearchRubrics($(obj));
		}
	});

	$mainCheckBox.click(
	function() {

	 	$cb = $subRubricList.find('input[type=checkbox]');
	 	$li = $subRubricList.find('li');

		if( this.checked )
		{
		 	$cb.attr('checked', 'yes');
		 	$li.removeClass('hide');
		}
		else 
		{
		 	$cb.attr('checked', null);
		 	$li.addClass('hide');
		}
		application.mapSearchRubrics($subRubricList);
	});

</script>