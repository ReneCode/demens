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
require("utility.php");

$admin = $_GET['admin'];

$dbCon = dbOpen();
$authorOption = getHtmlOption($dbCon, "status", "");

$query = "select * from tblprobe order by status,author";
$result = mysql_query($query, $dbCon);
$adminHtml = "";
if ($admin != "") {
	$adminHtml = 
		'<input type="submit" formaction="delete.php" value="Löschen"/>'; 
}

while ($row = mysql_fetch_assoc($result)) 
{
	$message = $row['message'];
	$id = $row['id'];
	// show CR-LF as new lines in html (<br>)
	$message = str_replace(array("\r\n"), '<br>', $message);
	$data = 
		'<form method="GET" action="change.php">'.
		sprintf('<p>%s</p>', $row['date']) . 
		sprintf('<p>%s</p>', $row['author']) .
		sprintf('<p>%s</p>', $row['status']) .
		sprintf('<p>%s</p>', $message) .
		'<input type="submit" value="Ändern"/>' .
		sprintf('<input type="hidden" name="id" value="%s"/>', $id) .
		$adminHtml .
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
