<!DOCTYPE html>
<html>
<header>
	<meta charset="utf-8">
	<title>List Probe</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="demens.js"></script>
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

while ($row = mysql_fetch_assoc($result)) 
{
	$message = $row['message'];
	$author = $row['author'];
	$id = $row['id'];
	// show CR-LF as new lines in html (<br>)
	$message = str_replace(array("\r\n"), '<br>', $message);
	if ($admin != "") {
		$adminHtml = 
			'<input type="submit" onclick="return confirmDelete(#author#);" formaction="delete.php" value="Löschen"/>'; 
		$adminHtml = str_replace(array("#author#"), "'$author'", $adminHtml);			
	}


	$data = 
		'<form method="GET" action="change.php">'.
		sprintf('<p>%s</p>', $row['date']) . 
		sprintf('<p>%s</p>', $author) .
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
