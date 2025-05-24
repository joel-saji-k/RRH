<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["password"]);  
?>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
header("Location: ../index.php");
exit();
?>
