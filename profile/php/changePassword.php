<?php
    $krestik = "<img src='/icons/krestik.svg' width=20px>";
    $errorServer = "<div class='mediumTextRed disFlex'>Произошла ошибка на сервере".$krestik."</div>";

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPasswordE = $_POST['newPasswordE'];
	if($newPassword == $newPasswordE && preg_match('/^[a-zA-Z\d]{6,30}$/', $newPassword) && $oldPassword != null){
        session_start();
        if(isset($_SESSION['user_card'])){
            include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
            $mysql = new mysqli($hostDB, $userDB, $passwordDB, $database) or die($errorServer);
            $result = $mysql->query('SELECT * FROM Change_Password WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
            if($result == null || time() >= $result['Time']){
                $stmt = $mysql->prepare('SELECT * FROM Users WHERE Card = '.$_SESSION['user_card']) or die($errorServer);
                $stmt->execute() or die($errorServer);
                $result = $stmt->get_result()->fetch_assoc();
                if(password_verify($oldPassword, $result['Password'])){
                    if($newPassword != $oldPassword){
                        include($_SERVER['DOCUMENT_ROOT'].'/php/sendMail.php');
                        $code;
                        do{
                            $code = bin2hex(random_bytes(18));
                        }while($mysql->query('SELECT * FROM Change_Password WHERE Code = "'.$code.'"')->fetch_assoc() != 0);
                        $stmt = $mysql->prepare('INSERT INTO Change_Password(Card, NewPassword, Time, Code) VALUES (?, ?, ?, ?)') or die($errorServer);
                        $stmt->bind_param("isis", $_SESSION['user_card'], $pas = password_hash($newPassword, PASSWORD_BCRYPT), $time = time()+(60*20), $code) or die($errorServer);
                        $stmt->execute() or die($errorServer);
                        if(sendMail($result['Email'], $result['Imya'], 'Смена пароля', 'Уважаемый, '.$result['Fam'].' '.$result['Imya'].', для того, чтобы подтвердить смену пароля, пожалуйста, перейдите по ссылке https://balgp100.pp.ua/profile/changepassword.php?code='.$code.'. Если вы не меняли пароль, то возможно ваш аккаунт был взломан.', 'Уважаемый, '.$result['Fam'].' '.$result['Imya'].', для того, чтобы подтвердить смену пароля, пожалуйста, перейдите по ссылке. Если вы не меняли пароль, то возможно ваш аккаунт был взломан.')){
                            echo "<div class='mediumTextGreen disFlex'>На почту ".$result['Email']." было отправлено письмо с подтверждением о смене пароля<img src='/icons/galochka.svg' style='width:20px; margin-left: 5px;'></div>";
                        }
                        else echo "<div class='mediumTextRed disFlex'>Неверно заполнены поля ".$krestik."</div>";
                    }
                    else echo "<div class='mediumTextRed disFlex'>Новый пароль не должен совпадать с текущим".$krestik."</div>";
                }
                else echo "<div class='mediumTextRed disFlex'>Неверно введен старый пароль".$krestik."</div>";
            }
            else echo '<div class="mediumTextRed disFlex">Вы уже пытались недавно сменить пароль. Следующая попытка будет доступна через '.(date("i:s", $result['Time']-time()).$krestik).'</div>';
            $mysql->close();
        }
        else echo "<div class='mediumTextRed disFlex'>Ошибка данных об пользователе".$krestik."</div>";
	}
    else echo "<div class='mediumTextRed disFlex'>Неверно заполнены поля".$krestik."</div>";
?>