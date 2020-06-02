<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            $cabinet = $_POST['cabinet'];
            $card = $_POST['card'];
            if(is_numeric($cabinet)){
                $stmt = $mysqli->prepare('UPDATE Raspisanie SET Cabinet = ? WHERE Card = ?') or die('Ошибка');
                $stmt->bind_param('ii', $cabinet, $card) or die('Ошибка');
                $stmt->execute() or die('Ошибка');
                echo 'Изменено';
            }
            else echo 'Кабинет не число';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
?>