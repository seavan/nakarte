// Sam's scripts
// requires jquery
// common controls

// select

// CSS classes used
// ui-seavan-val
// ui-seavan-select
// ui-seavan-option
// ui-seavan-option-header
// ui-seavan-option-index
// ui-seavan-option-body
// ui-seavan-jsonControl


(function($){

	/*$.fn.valOld = $.fn.val;

	$.fn.val = function($param)  {
	if( $(this).hasClass('ui-seavan-val'))
	{
	if( $(this).getOpts().seavanVal )
	{
	return $(this).getOpts().seavanVal(this);
	}
	else
	{
	alert('no seavanVal present in opts');
	}
	}
	return $.fn.val($param);
	}*/

	jQuery.fn.outer = function() {
		return $( $('<div></div>').html(this.clone()) ).html();
	}

	$.fn.getOpts = function() {
		return $(this).data('opts');
	}

	$.fn.seavanSelect = function(opts) {
		opts.seavanVal = function(_ref) {
			alert('seavanVal called');
		}
		return $(this).jsonControl(opts).addClass('ui-seavan-val ui-seavan-select');
	}

	$.fn.jsonControl = function(opts) {
		if( !opts.getUpdateUrl && opts.update_url ) {
			opts.getUpdateUrl = function() {
				return opts.update_url;
			}
		}

		this.addClass('ui-seavan-jsonControl');

		return this.each( function() {

			$(this).data('opts', opts);
		});
	}

	$.fn.jsonUpdate = function(){
		return this.each( function() {
			opts = $(this).getOpts();
			if(opts.getUpdateUrl)
				{
				callback = function(_data) {
					$this = $(this);
					opts = $this.getOpts();
					$this.empty();
					data = _data.result;
					if( data == null ) return;
					if(opts.prebind) {
						opts.prebind(this, data);
					}

					for(i = 0; i < data.length; ++i)
						{
						if(opts.populateItem)
							{
							//$(this).append("<option>teset</option>");
							$this.append(opts.populateItem(this, data[i], i));
						}
						else
							{
							alert('no populateItem specified');
						}
					}

					if(opts.rebind) {
						opts.rebind(this, data);
					}
				};
				postdata = null;
				if(opts.getPostData) postdata = opts.getPostData();

				$.ajax({
					url: opts.getUpdateUrl(this),
					dataType: 'json',
					data: postdata,
					type: 'POST',
					context: this,
					success: callback
				});
			}
			else
			{
				alert('no getUpdateUrl specified');
			}
			return $();
		});
	};

	$.fn.popup = function(_div, _invoker)
	{
		toggler = function()
		{
			$invoker = $(_invoker);
			$div = $(_div);
			//_preEvent($div, $invoker);
			if($div.hasClass('_popupActive'))
			{
				$div.removeClass('_popupActive');
				$div.fadeOut();
			}
			else
			{
				$div.addClass('_popupRequest');
				$div.fadeIn();
			}
		}	
		
		$(_invoker).click(toggler);
	}

})(jQuery);


function monitorEnter(event, object, func)
{
	if(event.keyCode == '13')
		{
		func(object);
		return false;
	}
	return true;
}

function bindSelects($selects, _userFunc)
{
	$selects.find('li').click(
	function()
	{
		$this = $(this);
		$rel = $this.attr('rel');
		$this.addClass('act');
		_userFunc($rel);
	});
}

function hidePopups()
{
	$r = $('._popupActive');
	$r.removeClass('_popupActive');
	$r.removeClass('show');
	$r.fadeOut();
}

function outerClickCheckerIn()
{
	$(document).bind('click', function(e) {
		var $clicked=$(e.target); // get the element clicked
		if($clicked.is('._popup') || $clicked.parents().is('._popup')) {
		}
		else {
			hidePopups();
			$('._popupRequest').addClass('_popupActive').removeClass('_popupRequest');
		}

	});
}

function outerClickCheckerOut()
{
	$(document).unbind('click');
}