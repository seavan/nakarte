
$(document).ready(
function()
{
	$slideshow = $('._slideshow');
	$pager = $('._slideshow ._pager');

	
	$pager.each( function()
	{
		$this = $(this);
		$this.empty();
		photoLimit = $this.attr('rel');

		$slideshow = $this.parents('._slideshow').first();
		
		$items = $slideshow.find('._item');
		$lentaWrap = $slideshow.find('._lentaWrap');

		if($items.length)
			{
			itemWidth = $items.outerWidth(true);
			itemLentaCount = Math.ceil( $lentaWrap.innerWidth() / itemWidth);

		
			$left = $slideshow.find('._next');
			$right = $slideshow.find('._prev');
			
			function move($obj, _step)
			{
				$parent = $obj.parents('._slideshow').first();
				$left = $parent.find('._prev');
				$right = $parent.find('._next');
				$items = $parent.find('._item');   
				
				pageCount = $parent.data('pageCount');
				itemWidth = $parent.data('itemWidth');

				$lenta = $parent.find('._lenta');
				$lenta.stop();
				left = $lenta.position().left;
				curItem = - Math.floor(left / itemWidth);
				curItem += _step;
				
				if( curItem >= $items.length ) curItem = $items.length - 1;
				if( curItem < 0 ) curItem = 0;
				
				
				$right.removeClass('hidenext');
				$left.removeClass('hideprev');
				
				if( curItem == 0 ) $left.addClass('hideprev');
				
				if( curItem == $items.length - 1 ) $right.addClass('hidenext');
				
				if(_step == 0) return;
													
				curPage = Math.floor(curItem / pageCount);
				
				$parent.find('._pager li').removeClass('cur').removeClass('_cur');
				$selPage = $parent.find('._pager li:eq(' + curPage + ')');  
				$selPage.addClass('cur _cur');
				
				$parent.data('pageShift', curItem - pageCount * curPage);
				$lenta.animate({ 'left': - curItem * itemWidth}, 200 );
			}
			

			$left.click( function() { move($(this), 1) } );
			$right.click( function() { move($(this), -1) } );
			
			pageCount = Math.floor( $items.length / itemLentaCount );
			$slideshow.data('pageCount', pageCount);				
			$slideshow.data('itemWidth', itemWidth);				
			for(i = 0; i < pageCount; ++i)
				{
				$this.append('<li>' + (i + 1) + '</li>');
			}
			$children = $this.children('li');
			$children.first().addClass('cur _cur');

			function updatePage($_obj, _force, _resetShift)
			{
				$this = $_obj;
				$parent = $this.parents('._slideshow').first();
				$adj = $parent.find('._pager li');
				$adj.not('._cur').removeClass('cur');

				$lenta = $parent.find('._lenta');
				$lenta.stop();

				$cur = $parent.find('._pager li._cur');
                
				if(_force && $this.hasClass('_cur')) 
				{
					$parent.find('._pager li._cur').not($this).removeClass('_cur').removeClass('cur');
					$cur = $this;
				}
				
				page = parseInt($cur.text()) - 1;
				
				if(_resetShift)
				{
					$parent.data('pageShift', 0);
				}
				
				pageShift = $parent.data('pageShift');
				pageCount = $parent.data('pageCount');
				itemWidth = $parent.data('itemWidth');
				position = page * pageCount + (pageShift ? pageShift : 0);
				left = - position * itemWidth;
				
				if(_force && (!$this.hasClass('_cur')))
				{
					parseInt($this.text()) - parseInt($cur.text()) < 0 ? 
					$lenta.animate({ left: left + 100}, 500 )
					: $lenta.animate({ left: left - 100}, 500 );
					return;
				}
				
				$lenta.animate({ 'left': left}, 1000, function() { move($lenta, 0)} );
				
			}

			$children.mouseenter( 
			function() { 

				$this = $(this);
				updatePage($this, true);
				$this.addClass('cur');
			} );

			$children.mouseleave(
			function()
			{
				$this = $(this);
				updatePage($this);
			});

			$children.click(
			function()
			{
				$this = $(this);

				$this.addClass('_cur');
				updatePage($this, true, true);
				$this.addClass('_cur cur');

			});
			
			move($left, 0);

		}
	}
	);


	//	alert($slideshow.length);	
	//	alert($slideinner_item.length);
	//	alert($slideinner_right.length);

	function animateLeft()
	{
		$slideinner.animate({
			'margin-left': '-=' + width,
		}, 10000, function() {
			animateRight();
		}			
		);
	}

	function animateRight()
	{
		$slideinner.animate({
			'margin-left': '+=' + width,
		}, 10000, function() {
			animateLeft();
		}			
		);
	}

}
	);