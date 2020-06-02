<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        if($mysqli->query('SELECT RankNumber FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc()['RankNumber'] == 10){
            $stmt = $mysqli->prepare('DELETE FROM Doctors WHERE Card = ?') or die('Ошибка');
            $stmt->bind_param('i', $_POST['card']) or die('Ошибка');
            $stmt->execute() or die('Ошибка');
            $stmt->prepare('DELETE FROM Raspisanie WHERE Card = ?') or die('Ошибка');
            $stmt->bind_param("i", $_POST['card']) or die('Ошибка');
            $stmt->execute();
            echo 'excellent';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
?>