<optgroup label="<?= $item->name ?>" rel="<?= $item->id ?>">
<?
	NakarteHtml::FormatOrmView($item->rubrics, 'widgets/rubrics/child_rubric');
?>
</optgroup>
