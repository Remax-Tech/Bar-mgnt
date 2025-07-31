<?php
session_start();

//redirected to login if not logged in
if (!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit();
}
require_once 'db.php';

//retrieve filter values from GET parameters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? trim($_GET['category']) : '';

//build SQL query with filters
$sql = "SELECT * FROM drinks WHERE 1=1";
$params = [];

//use parameters safely
if (!empty($search)) {
    $sql .= " AND (LOWER(name) LIKE LOWER('%' || :search || '%') OR LOWER(category) LIKE LOWER('%' || :search || '%') OR LOWER(description) LIKE LOWER('%' || :search || '%'))";
    //$params[':search'] = '%' . $search . '%';
}
if (!empty($category_filter)) {
    $sql .= " AND category = :category";
    //$params[':category'] = $category_filter;
}
$sql .= " ORDER BY name ASC";

// prepare statement
$stmt = $db->prepare($sql);

// bind values (sqlite3 style)
if (!empty($search)) {
    $stmt->bindvalue(':search', $search, SQLITE3_TEXT);
}
if (!empty($category_filter)) {
    $stmt->bindvalue(':category', $category_filter, SQLITE3_TEXT);
}
// execute query
$results = $stmt->execute();
$drinks = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    if ($row) {
        $drinks[] = $row;
    }
}

//foreach ($params as $key => $value) {
 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Drinks</title>
        <link rel="stylesheet" href="bar.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="vd-p">
    <h1 class="vd-p">Drink Inventory</h1>
    <a href="add_drink.php" class="btn">+ Add Drink</a>

    <form method="GET" action="" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">

        <select name="category">
            <option value="">Toutes Categorys</option>
            <option value="Beer" <?= $category_filter == 'Beer' ? 'selected' : '' ?>>Beer</option>
            <option value="Jus" <?= $category_filter == 'Jus' ? 'selected' : '' ?>>Jus</option>
            <option value="Canette" <?= $category_filter == 'Canette' ? 'selected' : '' ?>>Canette</option>
            <option value="Eau" <?= $category_filter == 'Eau' ? 'selected' : '' ?>>Eau</option>
            <option value="Yaourt" <?= $category_filter == 'Yaourt' ? 'selected' : '' ?>>Yaourt</option>
        </select>
        <button type="submit">Rechercher</button>
        <a href="view_drinks.php" style="margin-left: 10px;">Reset</a>
    </form>
<?php if (count($drinks) > 0): ?>
    <table class="table table-striped table-hover mt-4">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Category</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

                <?php while (($row = $results->fetchArray(SQLITE3_ASSOC)) !== false): ?>
                    <?php if ($row !== null && is_array($row)): ?>
        <tbody> 
            <tr class="<?= ($row['quantity'] <= 5) ? 'low-stock' : '' ?>">
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?>
                    <?= ($row['quantity'] <= 5) ? '<br><span style="color:red;">Low stock!</span>' : '' ?></td>
                <td><?= htmlspecialchars($row['price']) ?> FCFA</td>
                <td><?php if (!empty($row['image_path']) && file_exists($row['image_path'])): ?>
    <!--image-->        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Drink image">
                    <?php else: ?> No Image
                    <?php endif; ?>
                </td>
                <td class="action-buttons">
                    <a href="edit_drink.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a> |
                    <a href="delete drink.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this drink?');">Delete</a>
                </td>
            </tr>
            <?php endif; ?>
            <?php endwhile; ?>
     </table>
        <?php else: ?>
            <tr>
                <td colspan="7">No drinks found.</td>
            </tr>
        <?php endif; ?>
    <tbody>

</body>
</html>

