<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            $day = $_POST['day'];
            $card = $_POST['card'];
            $time0 = $_POST['time0'];
            $time1 = $_POST['time1'];
            if(strtotime($time1) > strtotime($time0)){
                if(strtotime($time1) % 900 == 0 && strtotime($time0) % 900 == 0){
                    $stmt = $mysqli->prepare('UPDATE Raspisanie SET '.($day == 'Monday' ? 'Monday' : (($day == 'Tuesday') ? 'Tuesday' : (($day == 'Wednesday') ? 'Wednesday' : (($day == 'Thursday') ? 'Thursday' : (($day == 'Friday') ? 'Friday' : ''))))).' = ? WHERE Card = ?') or die('Ошибка');
                    $stmt->bind_param("si", $time = $time0.'-'.$time1, $card) or die('Ошибка');
                    $stmt->execute() or die('Ошибка');
                    echo 'Время изменено';
                }
                else echo 'Время приема должно составлять 15 минут';
            }
            else echo 'Неправильно указано время';
        }
        else echo 'У вас недостаточно прав';
        $mysqli->close();
    }
    else echo 'У вас недостаточно прав';
?>