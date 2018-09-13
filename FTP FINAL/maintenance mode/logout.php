<?php
session_start();
$_SESSION['logstate'] = FALSE;
header('Location: home.php');
?>