<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT RankNumber FROM Doctors WHERE Card = ?');
        $stmt->bind_param('i', $_SESSION['user_card']);
        $stmt->execute();
        $vr = $stmt->get_result()->fetch_assoc();
        if($vr && ($vr['RankNumber'] == '1' || $vr['RankNumber'] == '3')){
            $stmt = $mysqli->prepare('SELECT * FROM Zapisi WHERE Doctor = ? AND Date > ? ORDER BY Date, Time');
            $stmt->bind_param('is', $_SESSION['user_card'], $vr = date('Y-m-d', time()));
            $stmt->execute();
            $zapisi = $stmt->get_result();
            while($zapis = $zapisi->fetch_assoc()){ 
                $user = $mysqli->query('SELECT Fam, Imya, Otch FROM Users WHERE Card = '.$zapis['Card'])->fetch_assoc();
                ?>
                <div class="zapisDivDoctor" idzapis="<?php echo $zapis['Id']; ?>">
                    <div class="zapisDivFlex">
                        <div class="mediumTextBlue"><?php echo $user['Fam'].' '.$user['Imya'].' '.$user['Otch']; ?></div>
                        <div class="mediumTextBlack"><?php echo date('d.m.y H:i', strtotime($zapis['Date'].' '.$zapis['Time'])); ?></div>
                    </div>
                    <div class="recept" idzapisRecept="<?php echo $zapis['Id']; ?>">
                        <textarea><?php echo $zapis['Content']; ?></textarea>
                        <input type="button" class="acceptRecept mediumTextBlack" value="Сохранить">
                    </div>
                </div>
                <?php
                }
        }
    }
?>