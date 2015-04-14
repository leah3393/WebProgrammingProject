<?php 
	$pid = $_POST["pid"];
	$oldHTML = file_get_contents('../../propertyInfo.html');
	$oldHTML = substr($oldHTML, 0, strpos($oldHTML, "</html>-->") + 10);
	file_put_contents('../../propertyInfo.html', $oldHTML);
	file_put_contents('../../propertyInfo.html', '<input type="hidden" id="pid" value="' . $pid . '" /></div></body></html>', FILE_APPEND);
	header("Location: ../../propertyInfo.html");
?>