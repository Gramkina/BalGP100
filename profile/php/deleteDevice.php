<?php
    $token = $_POST['token'];
    $series = $_POST['series'];
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
    $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
    $stmt = $mysqli->prepare('DELETE FROM tokens WHERE token = ? AND series = ?') or die(2);
    $stmt->bind_param("ss", $token, $series) or die(2);
    $stmt->execute() or die(2);
?>