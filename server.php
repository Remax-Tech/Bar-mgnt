<?php
session_start();
if (!isset($_SESSION['admin'])){
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}
?>