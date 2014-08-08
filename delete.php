<?php

include("db.php");

$id = $_GET[id];

$dbCon = dbOpen();

$sql = sprintf("DELETE FROM tblprobe WHERE  id=%d", $id);
mysql_query($sql);

dbClose();

$url = 'list.php?admin=1';
header("Location: $url");

?>

