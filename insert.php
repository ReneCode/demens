<?php

include("db.php");

$date = $_POST[date];
$author = $_POST[author];
$status = $_POST[status];
$message = $_POST[message];
$id = $_POST[id];

$dbCon = dbOpen();

$sql = "INSERT INTO tblprobe (date, author, status, message) VALUES ('$date', '$author', '$status', '$message')";
if ($id > 0) {
	$sql = sprintf("UPDATE tblprobe SET author='%s', date='%s', status='%s', message='%s' WHERE  id=%d", $author, $date, $status, $message, $id);
}


mysql_query($sql);

dbClose();

$url = 'list.php';
header("Location: $url");

?>

