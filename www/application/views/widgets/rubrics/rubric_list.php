<div class="fl_r select _availableRubrics">
	<label>Все рубрики:</label>
	<select size="9" multiple=multiple>
<?
	$rubrics = $this->get_parent_rubrics();
	NakarteHtml::FormatOrmView($this->get_parent_rubrics(), 'widgets/rubrics/parent_rubric');
?>
	</select>
	<small>Для добавления рубрики - двойной щелчок</small>
</div>