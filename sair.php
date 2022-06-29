<?php
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['nivel-acesso']);

header("Location: login.php");