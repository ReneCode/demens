<!DOCTYPE html>
<html>
<header>
	<meta charset="utf-8">
	<title>Eintrag Probe</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="demens.js"></script>
</header>

<?php
require("db.php");
require("utility.php");

// open database
$dbCon = dbOpen();


$curAuthor = "";
$curStatus = "";
$curDate = "";
$curMessage = "";
// may be there is a record-id
$curId = $_GET['id'];

$bRecordFound = false;
if ($curId > 0) {
	$sql = sprintf("select * from tblprobe where id = %d", $curId);
	$result = mysql_query($sql, $dbCon);
	$row = mysql_fetch_assoc($result);
	if ($row) {
		$bRecordFound = true;
		$curAuthor = $row['author'];
		$curStatus = $row['status'];
		$curMessage = $row['message'];
		$curDate = $row['date'];
	}
} 

if (!$bRecordFound) {
	// get the date from the first record
	$sql = sprintf("select date from tblprobe ORDER BY id LIMIT 1");
	$result = mysql_query($sql, $dbCon);
	$row = mysql_fetch_assoc($result);
	if ($row) {
		$curDate = $row['date'];
	}
	else {
		$tim = time();
		// get next dienstag
		$tim = getNextDateWithWeekDay($tim, 2);
		$weekDay = date('N', $tim);
		$curDate = GetGermanWeekDay($weekDay) . ', ' . date('j.n.Y', $tim);
	}
}


$authorOption = getHtmlOption($dbCon, "author", $curAuthor);
$statusOption = getHtmlOption($dbCon, "status", $curStatus);


?>
<body>
	<div>
	<form method="POST" action="insert.php" onSubmit="return checkValues(this);">
	 <table class="table">
		 <tbody>
		 	<tr>
		 		<td class="label">Datum</td>
		 		<td class="input"><input type="text" name="date" value="<?php echo $curDate ?>"/></td>
		 	</tr>

		 	<tr>
		 		<td class="label">Eintrag von</td>
		 		<td class="input">
		 		 <select name="author"><?php echo $authorOption ?></select>
		 		</td>
		 	</tr>

		 	<tr>
		 		<td class="label">Status</td>
		 		<td class="input">
		 		 <select name="status"><?php echo $statusOption ?></select>
		 		</td>
		 	</tr>

		 	<tr>
		 		<td class="label">Mitteilung</td>
		 		<td class="input"><textarea cols="70" rows="15" name="message"><?php echo $curMessage ?></textarea></td>
		 	</tr>

		 	<tr>
		 		<td></td>
		 		<td>
				<input type="hidden" name="id" value="<?php echo $curId ?>"/>
				<input type="submit" onclick="return goBack();" value="Zurück"/>
		 		<input type="submit" value="Absenden"/>
		 		</td>
		 	</tr>
		</tbody>
	 </table>
 </form>
</div>


</body>

</html>
