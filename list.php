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
	 	<table class="table">
		 <tbody>
		 	<tr><td>
				<form method="GET" action="change.php">
				<div class"right"><input type="submit" value="Neuer Eintrag"/></div>
				</form>
		 	</td></tr>

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
		'<div class="list-top">' .
		sprintf('<div class="date">%s</div>', $row['date']) . 
		sprintf('<div class="author">%s</div>', $author) .
		sprintf('<div class="status">%s</div>', $row['status']) .
		'</div><div class="list-bottom">' .
		sprintf('<div class="message">%s</div>', $message) .
		'</div>' .
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
