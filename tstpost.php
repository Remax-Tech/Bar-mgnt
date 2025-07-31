<!DOCTYPE html>
<html>
    <body>
<form mathod="POST" action="testform.php">
        <input type="text" name="test" value="abc">
        <button type="submit">Mettre a jour</button>
</form>

<?php
echo "<pre>"; 
echo "REQUEST METHOD: " . $_SERVER['REQUEST_METHOD'] ."\n";
print_r($_POST);  
echo "</pre>";
?>
</body>
</html>