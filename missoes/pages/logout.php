<?php require_once '../php/functions.php'; session_start(); session_unset(); session_destroy(); header('Location: index.php'); exit; ?>
