<!DOCTYPE html>
<html>
<header>
	<meta charset="utf-8">
	<title>List Probe</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</header>
<body>

	<div>
		<form method="GET" action="change.php">
		<div class"right"><input type="submit" value="Neuer Eintrag"/></div>
		</form>
	</div>
	<div>
	 	<table class="table">
		 <tbody>

<?php

require("db.php");

$dbCon = dbOpen();
$authorOption = getHtmlOption($dbCon, "status", "");


$query = "select * from tblprobe order by id";
$result = mysql_query($query, $dbCon);

while ($row = mysql_fetch_assoc($result)) 
{
	$data = 
		'<form method="GET" action="change.php">'.
		sprintf('<p>%s</p>', $row['date']) . 
		sprintf('<p>%s</p>', $row['author']) .
		sprintf('<p>%s</p>', $row['status']) .
		sprintf('<p>%s</p>', $row['message']) .
		'<div class"right"><input type="submit" value="Ändern"/></div>' .
		sprintf('<input type="hidden" name="id" value="%s"/>', $row['id']) .
		"</form>";
	$out = sprintf('<tr><td class="listdata">%s</td></tr>', $data);
	print_r($out);
}
dbClose();

?>
		</tbody>
	 </table>
 </form>
</div>


</body>

</html>
