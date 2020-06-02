<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            if($_POST['zagolovok'] && $_POST['htmlText'] && $_FILES['photo']){
                $dir = $_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.date('d.m.Y H:i', time());
                if(mkdir($dir) && file_put_contents($dir.'/news', $_POST['zagolovok'].PHP_EOL.$_POST['htmlText']))
                    if(move_uploaded_file($_FILES['photo']['tmp_name'], $dir.'/head.jpg')){
                        $image = imagecreatefromjpeg($dir.'/head.jpg') ? imagecreatefromjpeg($dir.'/head.jpg') : imagecreatefrompng($dir.'/head.jpg');
                        if($image = imagescale($image, 400, 250)){
                            imagejpeg($image, $dir.'/head.jpg');
                            echo 'Новость успешно добавлена';
                        }
                        else echo 'Ошибка';
                    }
                    else echo 'Ошибка';
                else 'Ошибка';
            }
            else echo 'Указаны не все данные';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
?>