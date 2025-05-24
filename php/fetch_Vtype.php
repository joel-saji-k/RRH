<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type'])) {
        $selectedType = $_POST['type'];
         echo "Vehicle type: " . htmlspecialchars($selectedType);

        unset($_SESSION['type']);
         $_SESSION['type'] = $selectedType;
        
    }
}
?>
