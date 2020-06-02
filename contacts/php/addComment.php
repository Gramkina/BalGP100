<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        $files = glob($_SERVER['DOCUMENT_ROOT'].'/contacts/comments/*'.$_SESSION['user_card'].'*');
        $comment = array();
        if($files){
            foreach($files as $value){
                $comment[$value] = strtotime(explode(' ', $value, 3)[2]);
            }
            arsort($comment);
            $comment = array_keys($comment);
        }
        if($comment && strtotime(explode(' ', $comment[0], 3)[2])+60>time()) exit('Отзыв можно оставлять только 1 раз в минуту');
        else{
            $comment = $_POST['comment'];
            if($comment != ''){
                $user = 'Аноним';
                if($_POST['anon'] == 'false'){
                    require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
                    $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
                    $user = $mysqli->query('SELECT Imya FROM Users WHERE Card = '.$_SESSION['user_card'])->fetch_assoc()['Imya'];
                    $mysqli->close();
                }
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/contacts/comments/'.$user.' '.$_SESSION['user_card'].' '.date('d.m.Y H:i:s'), $comment);
                echo 'excellent';
            }
            else echo 'Отзыв не может быть пустым';
        }
    }
    else echo 'У вас недостаточно прав';
?>