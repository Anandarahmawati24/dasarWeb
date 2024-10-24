<?php
session_start(); 
session_destroy();
header("Location: login.php");
exit; 
?>
<!DOCTYPE html>
<html>
<form action="logout.php" method="POST" style="display:inline;">
    <button type="submit">Logout</button>
</form>
</html>