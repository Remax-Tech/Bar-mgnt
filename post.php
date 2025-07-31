<!DOCTYPE html>
<html>
    <body>
<form mathod="POST" action="post.php">
        <input type="text" name="test" value="abc">
        <button type="submit">Mettre a jour</button>
</form>

<?php
echo "<pre>"; 
print_r($_POST);  
echo "</pre>";
?>
</body>
</html>