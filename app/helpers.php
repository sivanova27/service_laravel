<?php

function search_array($needle, $haystack) {
     if(in_array($needle, $haystack)) {
          return true;
     }
     foreach($haystack as $element) {
          if(is_array($element) && search_array($needle, $element))
               return true;
     }
   return false;
}

function days2bool($days, $fill=null) {
	$week_days=array('Mon'=>0, 'Tue'=>0, 'Wed'=>0, 'Thu'=>0, 'Fri'=>0, 'Sat'=>0, 'Sun'=>0);
	if ($fill) {
		foreach($week_days as $day=>$k) { $week_days[$day]=$fill; }
	}
	foreach($days as $k=>$day) { $week_days[$day]=1; }
	return implode('', $week_days);
}

function bool2days($str) {
	$week_days=array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
	$chars=str_split($str);
	foreach($chars as $i=>$char) {
		if ($char==1) { $days[]=$week_days[$i]; }
	}
	return $days;
}

?>