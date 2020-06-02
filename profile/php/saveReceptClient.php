<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT RankNumber FROM Doctors WHERE Card = ?');
        $stmt->bind_param('i', $_SESSION['user_card']);
        $stmt->execute();
        $vr = $stmt->get_result()->fetch_assoc();
        if($vr && ($vr['RankNumber'] == '1' || $vr['RankNumber'] == '3')){
            $stmt = $mysqli->prepare('UPDATE Zapisi SET Content = ? WHERE Id = ?');
            $stmt->bind_param('si', $_POST['content'], $_POST['id']);
            $stmt->execute();
            print_r($_POST);
        }
    }
?>