<?php
//db.php
$db = new SQLite3('bar.db');

// optional: enable exceptions for debugging (you can remove in production)
$db->enableExceptions(true);


//$conn = new mysqli($servername, $username, $password, $dbname);

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "bar_mgnt";
?>