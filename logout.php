<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['login']);
// Delete all session variables
// session_destroy();

// Jump to login page
header('Location: login.html');

?>