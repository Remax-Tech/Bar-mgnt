<?php
$db = new SQLite3('bar.db');
$search = 'beer';

$stmt = $db->prepare("SELECT * FROM drinks WHERE LOWER(category) LIKE LOWER(:search)");
$stmt->bindValue(':search', "%$search%", SQLITE3_TEXT);
$result = $stmt->execute();

echo "<h2>Search Result for 'beer'</h2>";
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    echo "<pre>" . print_r($row, true) . "</pre>";
}
?>