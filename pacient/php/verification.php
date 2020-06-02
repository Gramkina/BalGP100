<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(isset($_SESSION['user_card'])){
        $code = $_POST['code'];
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT * FROM vr_zapisi WHERE Code = ?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $resultVRzapisi = $stmt->get_result()->fetch_assoc();
        if($resultVRzapisi){
            $stmt = $mysqli->prepare('INSERT INTO Zapisi(Card, Date, Time, Doctor) VALUES(?, ?, ?, ?)') or die('Ошибка на сервере');
            $stmt->bind_param('issi', $resultVRzapisi['Card'], $resultVRzapisi['Date'], $resultVRzapisi['Time'], $resultVRzapisi['Doctor']) or die('Ошибка на сервере');
            $stmt->execute() or die('Ошибка на сервере');
            $mysqli->query('DELETE FROM vr_zapisi WHERE Code = \''.$code.'\'') or die('Ошибка на сервере');
            echo 3;
        }
        else echo 'Неверный код';
        $mysqli->close();
    }	
?>