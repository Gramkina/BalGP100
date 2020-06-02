<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            $rank = $_POST['rank'];
            $rankNumber = $_POST['rankNumber'];
            $card = $_POST['card'];
            $stmt = $mysqli->prepare('SELECT * FROM Users WHERE Card = ?') or die('<div class="mediumTextBlack">Ошибка</div>');
            $stmt->bind_Param('i', $card) or die('<div class="mediumTextBlack">Ошибка</div>');
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if($result){
                $stmt = $mysqli->prepare('SELECT * FROM Doctors WHERE Card = ?') or die('<div class="mediumTextBlack">Ошибка</div>');
                $stmt->bind_Param('i', $card) or die('<div class="mediumTextBlack">Ошибка</div>');
                $stmt->execute();
                $result = $stmt->get_result()->fetch_assoc();
                if(!$result){
                    if($rank != null){
                        if($rankNumber == 1 || $rankNumber == 2 || $rankNumber == 3 || $rankNumber == 10){
                            $stmt = $mysqli->prepare('INSERT INTO Doctors(Card, Rank, Info, RankNumber) VALUES(?, ?, ?, ?)') or die('<div class="mediumTextBlack">Ошибка</div>');
                            $stmt->bind_Param('issi', $card, $rank, $info = 'fsdf', $rankNumber) or die('<div class="mediumTextBlack">Ошибка</div>');
                            $stmt->execute() or die('<div class="mediumTextBlack">Ошибка</div>');
                            $stmt = $mysqli->prepare('INSERT INTO Raspisanie(Card) VALUES(?)') or die('<div class="mediumTextBlack">Ошибка</div>');
                            $stmt->bind_Param('i', $card) or die('<div class="mediumTextBlack">Ошибка</div>');
                            $stmt->execute() or die('<div class="mediumTextBlack">Ошибка</div>');
                            echo 'excellent';
                        }
                        else echo '<div class="mediumTextBlack">Неверно указан номер должности.</div>';
                    }
                    else echo '<div class="mediumTextBlack">Поле должность не должно быть пустым.</div>';
                }
                else echo '<div class="mediumTextBlack">Такого пользователь уже добавлен.</div>';
            }
            else echo '<div class="mediumTextBlack">Такого пользователя не существует.</div>';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
?>