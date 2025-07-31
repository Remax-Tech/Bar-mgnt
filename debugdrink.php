<?php
$db = new SQLite3('bar.db');
$result = $db->query("SELECT name, category FROM drinks");

echo "<h2>All Drinks</h2>";
echo "<table border='1'>";
echo "<tr><th>Name</th><th>Category</th></tr>";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr><td>{$row['name']}</td><td>" . htmlentities($row['category']) . "</td></tr>";
}
echo "</table>";
?>