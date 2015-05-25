<?php
  /* 
  
  $selected_template;
  $normal_template;
  $segment_index;
  $items;
  $clear_after
  */
  
  // @todo: убрать условие, если в people нужна сортировка all/latest
  $q=(uri::segment(1) <> 'people')?strchr(url::current(true),'?'):'';
  $curi = '/' . $this->uri->string();  
  $csegment = $this->uri->segment($segment);  
  foreach($items as $uri => $caption)
  {
  	  $template = ($csegment == $uri) ? $selected_template : $normal_template;
  	  
  	  if(isset($clear_after) && ($clear_after))
  	  {
  	  	$uri = preg_replace("#/$csegment.*#", '/' . $uri, $curi).$q;
	  }
	  else
	  {
	  	$uri = preg_replace("#/$csegment#", '/' . $uri, $curi).$q;
	  }
  	  
  	  
  	  $output = preg_replace('/\\%url/', $uri, $template);
  	  $output = preg_replace('/\\%caption/', $caption, $output);
  	  echo $output;
  }
?>
