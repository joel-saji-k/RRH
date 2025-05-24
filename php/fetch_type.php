<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fuel'])) {
        $selectedFuel = $_POST['fuel'];
        $selectedBrand = $_POST['brand'];
        // You can now use $selectedBrand as needed
         echo "Fuel type: " . htmlspecialchars($selectedFuel) . ", Brand: " . htmlspecialchars($selectedBrand);

        unset($_SESSION['fuel']);
        unset($_SESSION['brand']);
         $_SESSION['brand'] = $selectedBrand;
        // Optionally, store it in a global variable
         $_SESSION['fuel'] = $selectedFuel; // Use with caution
    }
}
?>
