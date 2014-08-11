<?php 


function dbGetOption($dbCon, $name) {
	$arr = array();
	$sql = sprintf("select val from tbloption where name='%s' order by val", $name);
	$result = mysql_query($sql, $dbCon);
	if ($result) {
		while ($row = mysql_fetch_assoc($result)) 
		{
			$val = $row['val']; 
			array_push($arr, $val); 
		}
	}
	return $arr;
}



function getHtmlOption($dbCon, $name, $currentValue = "") {
	$arr = dbGetOption($dbCon, $name);
#	print_r(" res:" . $arr[0]);
	$result = "";
	$bSelected = false;
	foreach ($arr as $val) {
		$sel = "";
		if ($currentValue  &&  $currentValue != ""  &&  $currentValue == $val) {
			$sel = " selected";
			$bSelected = true;
		}
#		print_r("value:" . $val . $sel);
		$result = $result . sprintf("<option%s>%s</option>", $sel, $val);
	}
	if (!$bSelected) {
		$result = $result . sprintf("<option selected>Bitte auswählen</option>");
	}
	return $result;
}



// 1 = Montag, 7 = Sonntag
function getGermanWeekDay($weekday) {
	switch ($weekday) {
		case 1: return "Montag";
		case 2: return "Dienstag";
		case 3: return "Mittwoch";
		case 4: return "Donnerstag";
		case 5: return "Freitag";
		case 6: return "Samstag";
		case 7: return "Sonntag";
		default: return "illegal:" . $n;
	}
}

function getNextDateWithWeekDay($tim, $weekday) {
	$tim = mktime(0, 0, 0, date("m", $tim)  , date("d", $tim), date("Y", $tim));
	while ( date('N', $tim) != $weekday) {
		$tim = mktime(0, 0, 0, date("m", $tim)  , date("d", $tim)+1, date("Y", $tim));
	}
	return $tim;
}

?>