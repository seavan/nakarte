<?php
  if($this->session->get('photo_error')):
?>
<div style="color: red; margin-top: 1em; margin-bottom: 1em;">
<p><? echo $this->session->get_once('photo_error') ?></p>
</div>
<? endif; ?>
