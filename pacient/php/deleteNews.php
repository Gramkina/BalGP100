<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            if(removeDir($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.$_POST['newsId']))
                echo 'excellent';
            else echo 'Ошибка';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';

    function removeDir($dir){
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach($files as $value){
            if(is_dir($dir.'/'.$value)) removeDir($dir.'/'.$value);
            unlink($dir.'/'.$value);
        }
        if(!rmdir($dir)) return false;
        return true;
    }
?>