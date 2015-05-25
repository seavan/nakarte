<div>
	<table>
		<tr>
			<td>
				<select style="width:600px" size="20" id="their_rubrics">

				</select>
			</td>
			<td>
				<select style="width:400px" size="20" id="our_rubrics">

				</select>
			</td>
		</tr>
	</table>
</div>

<script language="javascript" type="text/javascript">

	$().ready( function()
	{
		$update_their = function($obj)
		{
			$corr = $our_rubrics.find('option[rel=' + $obj.attr('rel') + ']');

			if($corr.length)
			{
				$obj.text(
				$obj.text() + '=>' +
					$corr.text());
				$obj.addClass('_ok');
				$obj.removeClass('_notok');
			}
			else
			{
				$obj.addClass('_notok');
				$obj.removeClass('_ok');
			}

		}

		$our_rubrics = $('#our_rubrics');

		$our_rubrics.jsonControl( { update_url: '/json/rubrics', populateItem:
				function(object, data, index)
			{
				if(data.rubric_id != null)
				{
					return $('<option rel=' + data.id + '>' + data.name + '</option>');
				}
				else
				{
					return $('<option disabled>--[' + data.name + ']--</option>');
				}
			},
			rebind: function()
			{
				$their_rubrics.find('option').each( function() { $update_their($(this)) } );
			}
		});

		$our_rubrics.dblclick( function()
		{
			$our_rel = $our_rubrics.find(':selected').attr('rel');
			$their_id = $their_rubrics.find(':selected').val();
			$their_rubrics.find(':selected').attr('rel', $our_rel);
			$update_their($their_rubrics.find(':selected'));
			$.ajax({
				url: '/json/update_import_1/' + $their_id + '/' + $our_rel,
				dataType: 'text',
				data: null,
				context: this,
			});
		});


		$their_rubrics = $('#their_rubrics');

		$their_rubrics.jsonControl( { update_url: '/json/import_rubrics_1', populateItem:
				function(object, data, index)
			{
				return $('<option value="' + data.id + '" rel=' + data.rubric_id + '>' + data.caption + '</option>');

			}, rebind: function()
			{
				$our_rubrics.jsonUpdate();
			}
		}
	);

		$their_rubrics.jsonUpdate();

	});


</script>
