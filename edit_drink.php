<?php
session_start();
require_once 'db.php';

//redirected to login if not logged in
if (!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit();
}

error_reporting(E_ALL);
ini_set('display_error', 1);

if (!isset($_GET['id'])) {
    echo "ID de boisson manquant.";
    exit();
}
$id = ($_GET['id']);
$stmt = $db->prepare("SELECT * FROM drinks WHERE id = :id");
$stmt->bindvalue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();
$drink = $result->fetchArray(SQLITE3_ASSOC);

if (!$drink) {
    echo "Boisson introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="bar.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifier une boisson</title>
</head>
<body class="ed">

<div class="mb-3">
    <h2 style="text-align: center;">Modifier la boisson</h2>
        <form action="update_drink.php" mathod="POST" enctype="multipart/form-data">

            <input type="hidden" name="drink_id" value="<?php echo $drink['id']; ?>">

        <lebel>Nom:</lebel>
        <input type="text" name="drink_name" value="<?php echo htmlspecialchars($drink['name']); ?>"><br>

        <lebel>Categorie:</lebel>
        <input type="text" name="category" value="<?php echo htmlspecialchars($drink['category']); ?>"><br>

        <lebel>Description:</lebel><br><br>
        <textarea name="description"><?php echo htmlspecialchars($drink['description']); ?></textarea><br>
         <br>
        <lebel>Quantité:</lebel><br>
         <input type="number" name="quantity" value="<?php echo $drink['quantity']; ?>"><br>
         <br>
        <lebel>Prix:</lebel><br>
         <input type="number" name="price" value="<?php echo $drink['price']; ?>" step="1"><br>
        <br>
        <lebel>Nouvelle Image (facultative):</lebel><br><br>
        <input type="file" name="image"><br>
         <!-- <small>Current:</small><br> -->
         <br>
        <button type="submit" name="update" class="btn btn-primary">Mettre a jour</button>

    </form>
</div>
</body>
</html>