<?php
session_start();
$uniqId = uniqid();
$_SESSION['id'] = $uniqId;
setcookie('pictures_met_id', $uniqId, 31536000, '/');
?>