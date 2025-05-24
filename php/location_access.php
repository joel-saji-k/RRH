<?php
session_start(); // Start a session to store the variables

// Check if the incoming data is from AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store each field in a PHP session variable
    if (isset($_POST['name'])) {
        $_SESSION['name'] = $_POST['name'];
    }
    if (isset($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
    }
    if (isset($_POST['lat'])) {
        $_SESSION['lat'] = $_POST['lat'];
    }
    if (isset($_POST['lon'])) {
        $_SESSION['lon'] = $_POST['lon'];
    }
}
