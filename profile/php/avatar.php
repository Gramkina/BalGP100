<?php
    $avatar = $_FILES['file'];

    if(($typeFile = exif_imagetype($avatar['tmp_name'])) == 2 || $typeFile == 3){
        if($avatar['size'] <= 524288){
            session_start();
            if(isset($_SESSION['user_card'])){
                if(move_uploaded_file($avatar['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/avatarUsers/'.$fileName = md5($_SESSION['user_card'].'_'.time()).'.jpg')){
                    $image = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/avatarUsers/'.$fileName) ? imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/avatarUsers/'.$fileName) : imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/avatarUsers/'.$fileName);
                    if($image = imagescale($image, 400, 400)){
                        imagejpeg($image, $_SERVER['DOCUMENT_ROOT'].'/avatarUsers/'.$fileName);
                        include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
                        $mysql = new mysqli($hostDB, $userDB, $passwordDB, $database) or die(3);
                        $stmt = $mysql->prepare('SELECT Avatar FROM Users WHERE Card = '.$_SESSION['user_card']) or die(3);
                        $stmt->execute() or die(3);
                        if(($avatarPath = $stmt->get_result()->fetch_assoc()['Avatar']) == null || unlink($_SERVER['DOCUMENT_ROOT'].'/avatarUsers//'.$avatarPath)){
                            $stmt = $mysql->prepare('UPDATE Users SET Avatar = ? WHERE Card = '.$_SESSION['user_card']) or die(3);
                            $stmt->bind_Param("s", $fileName) or die(3);
                            $stmt->execute() or die(3);
                            $mysql->close();
                            echo 4;
                        }
                        else{
                            unlink($_SERVER['DOCUMENT_ROOT'].'/avatarUsers//'.$fileName);
                            echo 3;
                        }
                    }
                    else echo 3;
                }
                else echo 3;
            }
            else echo 2;
        }
        else echo 1;
    }
    else echo 0;
?>