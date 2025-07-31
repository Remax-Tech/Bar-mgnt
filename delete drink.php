<?php
session_start();
require_once 'db.php';

//redirected to login if not logged in
if (!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //optional: remove image from the uploads folder
    $stmt = $db->prepare("DELETE FROM drinks WHERE id = ?");
    $stmt->bindValue(1, $id, SQLITE3_INTEGER);
    $stmt->execute();

   // if ($data && !empty($data['image'])) {
     // $filepath = 'uploads/' . $data['image'];
    //  if (file_exists($filepath)) {
      //  unlink($filepath); //delete the image file
      
   
    //$stmt = $db->prepare("DELETE FROM drinks WHERE id = :id");
    //$stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    header("Location: view_drinks.php");
    exit();
    } else {
      echo "Delete failed.";
    }
?>