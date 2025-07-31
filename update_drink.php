<?php
session_start();
require_once 'db.php';

//redirected to login if not logged in
if (!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<pre>"; 
print_r($_POST); 
print_r($_FILES); 
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $image = null;
    if (!isset($_FILES['image']) && $_FILES['name']['error'] === UPLOAD_ERR_OK) { 
        $image = $_FILES["image"]["name"];
        //$targetDir = "uploads/";
       move_uploaded_file($_FILES["image"]["tmp_name"], '/uploads' . $image);
    }

//keep the existing image
        //$stmt = $db->prepare("SELECT image FROM drinks WHERE id=:id");
       // $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
       // $result = $stmt->execute();
      //  $data = $result->fetchArray(SQLITE3_ASSOC);
      //  $image = $data['image'];

    if ($image){
        $stmt = $db->prepare("UPDATE drinks SET name = ?, category = ?, description = ?, quantity = ?, price = ?, image = ? WHERE id = ?");   
        $stmt->bindvalue(1, $name);
        $stmt->bindvalue(2, $category);
        $stmt->bindvalue(3, $description);
        $stmt->bindvalue(4, $quantity);
        $stmt->bindvalue(5, $price);
        $stmt->bindvalue(6, $image);
        $stmt->bindvalue(7, $id, SQLITE3_INTEGER);
 }  else {
    $stmt = $db->prepare("UPDATE drinks SET name = ?, category = ?, description = ?, quantity = ?, price = ? WHERE id = ?");   
    $stmt->bindvalue(1, $name);
    $stmt->bindvalue(2, $category);
    $stmt->bindvalue(3, $description);
    $stmt->bindvalue(4, $quantity);
    $stmt->bindvalue(5, $price);
    $stmt->bindvalue(6, $id, SQLITE3_INTEGER);
 }
   if ($stmt->execute()) {
    header("Location: view_drinks.php");
    exit();
    } else {
        echo "Échec de la mise á jour.";
    }
} else {
    echo "Requete invalid.";
}
?>