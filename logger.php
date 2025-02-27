<?php
    session_start(); // Start the session

    if(!isset($_SESSION['username'])){
        header("Location: logger.html"); // Redirect to login page if not logged in
        exit();
    }
?>
