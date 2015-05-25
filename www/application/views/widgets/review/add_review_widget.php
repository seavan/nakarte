<form action="" method="post">
	<input type="hidden" name="vote" id="vote"/>
	<dl class="addCommentBlock">
		<dt>Оставьте свой отзыв </dt>
		<dd>
			<textarea rows="1" cols="1" name="text"></textarea>

			<span class="h">И, если хотите, проголосуйте</span>
			<ul class="star-rating">
				<li style="width: 0%;" class="current-rating">0</li>
				<li><a style="width: 20%; z-index: 6;" title="1/5" rel="1" href="#1">1</a></li>
				<li><a style="width: 40%; z-index: 5;" title="2/5" rel="2" href="#2">2</a></li>
				<li><a style="width: 60%; z-index: 4;" title="3/5" rel="3" href="#3">3</a></li>
				<li><a style="width: 80%; z-index: 3;" title="4/5" rel="4" href="#4">4</a></li>
				<li><a style="width: 100%; z-index: 2;" title="5/5" rel="5" href="#5">5</a></li>
			</ul>

			<div class="but"><input type="submit" name="add_comment" value="добавить отзыв" class="ibutton" /></div>
		</dd>
	</dl>
</form>
<script language="javascript" type="text/javascript">
	$().ready()
	{
		$('.star-rating a').unbind();
		$('.star-rating a').click( function()
		{
			$(this).parents('ul').first().find('a').removeClass('current-rating');
			$(this).addClass('current-rating');
			$('#vote').val($(this).attr('rel'));
		});
	}
</script>