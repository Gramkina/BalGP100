<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT * FROM Zapisi WHERE Card = ? AND Date > ? ORDER BY Date, Time');
        $stmt->bind_param('is', $_SESSION['user_card'], $vr = date('Y-m-d', time()));
        $stmt->execute();
        $zapisi = $stmt->get_result();
        while($zapis = $zapisi->fetch_assoc()){ 
            $user = $mysqli->query('SELECT Fam, Imya, Otch FROM Users WHERE Card = '.$zapis['Doctor'])->fetch_assoc();
            $doctor = $mysqli->query('SELECT Rank FROM Doctors WHERE Card = '.$zapis['Doctor'])->fetch_assoc();
            ?>
            <div class="zapisDiv" idzapis="<?php echo $zapis['Id']; ?>">
                <div class="zapisDivFlex">
                    <div>
                        <div class="mediumTextBlack"><?php echo $doctor['Rank']; ?></div>
                        <div class="mediumTextBlue" style="margin-top: 10px;"><?php echo $user['Fam'].' '.$user['Imya'].' '.$user['Otch']; ?></div>
                    </div>
                    <div class="mediumTextBlack" ><?php echo date('d.m.y H:i', strtotime($zapis['Date'].' '.$zapis['Time'])); ?></div>
                </div>
                <div class="recept"></div>
            </div>
    <?php
        }
    }
?>