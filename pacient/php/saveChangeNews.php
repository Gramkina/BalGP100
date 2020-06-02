<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            $news = $_POST['news'];
            $text = $_POST['text'];
            $string = explode(PHP_EOL, file_get_contents($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.$news.'/news'), 2)[0].PHP_EOL.$text;
            if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.$news.'/news', $string))
                echo 'excellent';
            else echo 'Ошибка';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
?>