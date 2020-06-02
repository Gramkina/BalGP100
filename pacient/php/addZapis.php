<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(isset($_SESSION['user_card'])){
        $doctor = $_POST['doctor'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT Id FROM Doctors WHERE Card = ?');
        $stmt->bind_param('i', $doctor);
        $stmt->execute();
        if($stmt->get_result()->fetch_assoc()){
            if($date != null && checkdate(date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)))){
                if($time != null && strtotime($time) % 900 == 0){
                    $stmt = $mysqli->prepare('SELECT Id FROM Zapisi WHERE Date = ? AND Time = ?');
                    $stmt->bind_param('ss', $date, $time);
                    $stmt->execute();
                    if(!$stmt->get_result()->fetch_assoc()){
                        $stmt = $mysqli->prepare('SELECT Id FROM vr_zapisi WHERE Date = ? AND Time = ?');
                        $stmt->bind_param('ss', $date, $time);
                        $stmt->execute();
                        if(!$stmt->get_result()->fetch_assoc()){
                            $code;
                            do{
                                $code = bin2hex(random_bytes(4));
                            }while($mysqli->query('SELECT Id FROM vr_zapisi WHERE Code = "'.$code.'"')->fetch_assoc() != 0);
                            $stmt = $mysqli->prepare('INSERT INTO vr_zapisi(Card, Time, Date, Doctor, Code, timeDelete) VALUES(?, ?, ?, ?, ?, ?)') or die(2);
                            $stmt->bind_param('issisi', $_SESSION['user_card'], $time, $date, $doctor, $code, $timeDelete=(time()+20*60)) or die(2);
                            $stmt->execute() or die(2);
                            $users = $mysqli->query('SELECT Email, Imya FROM Users WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
                            require_once($_SERVER['DOCUMENT_ROOT'].'/php/sendMail.php');
                            if(sendMail($users['Email'], $users['Imya'], 'Подтверждение записи на прием', 'Ваш код для подтверждения записи на прием: '.$code, 'Ваш код для подтверждения записи на прием: '.$code)){
                                echo 1;
                            }
                            else echo 7;
                        }
                        else echo 6;
                    }
                    else echo 5;
                }
                else echo 4;
            }
            else echo 3;
        }
        else echo 2;
        $mysqli->close();
    }	
?>