<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';

//create or open the database
//$db = new SQLite3($dbPath);

//create admins table if not exists
$db->exec("CREATE TABLE IF NOT EXISTS admins 
(id INTEGER PRIMARY KEY AUTOINCREMENT,
username TEXT UNIQUE,
password TEXT)");

// add default admin user if none exists
    $username = 'admin';
    $password = 'admin123';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //fix: uses a prepared statement
   // $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
    
    $stmt = $db->prepare("INSERT OR IGNORE INTO admins (username, password) VALUES (:username, :password)");
        $stmt->bindvalue(':username', $username, SQLITE3_TEXT);
        $stmt->bindvalue(':password', $hashedPassword, SQLITE3_TEXT);
        $stmt->execute();

// create the drinks table 
$db->exec("CREATE TABLE IF NOT EXISTS drinks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    category TEXT NOT NULL,
    description TEXT,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,
    image TEXT)");        

        echo "Setup complete!";
?>