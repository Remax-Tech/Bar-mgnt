<?php
require_once 'db.php';

// $db = new SQLite3('bar.bd');
$result = $db->query("SELECT * FROM admins");

while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    echo "Username: " . $row['username'] . "<br>";
    echo "Password Hash: " . $row['password'] . "<br><br>";
}
?>