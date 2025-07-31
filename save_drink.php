<?php
session_start();
require_once 'db.php';

//redirected to login if not logged in
if (!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit();
}

// get data from the form 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

//image upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) { 
        $targetDir = "uploads/";
        if (!is_dir($targetDir)){
            mkdir($targetDir);
        }

        $imagePath = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }
    
    // insert into database
    //prepare insert statement
    $stmt = $db->prepare("INSERT INTO drinks (name, category, description, price, quantity, image) VALUES (:name, :category, :description, :price, :quantity, :image)");
    $stmt->bindvalue(':name', $name, SQLITE3_TEXT);
    $stmt->bindvalue(':category', $category, SQLITE3_TEXT);
    $stmt->bindvalue(':description', $description, SQLITE3_TEXT);
    $stmt->bindvalue(':price', $price, SQLITE3_FLOAT);
    $stmt->bindvalue(':quantity', $quantity, SQLITE3_INTEGER);
    $stmt->bindvalue(':image', $image, SQLITE3_TEXT);
    $stmt->execute();

    header("Location: view_drinks.php");
    exit();



    //move uploaded file
    //if (!move_uploaded_file($imageTmpName, $targetFile)){
    //    die("Image upload failed.");

//$stmt->bind_param("sssdis", $name, $category, $description, $price, $quantity, $imageName);

//else {   echo "Error:" . $stmt->error;}
//$stmt->close();
//$conn->close();

?>
