<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(isset($_SESSION['user_card'])){
        $spec = $_POST['spec'];
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT Card, Fam, Imya, Otch FROM Users WHERE Card = (SELECT Card FROM Doctors WHERE Rank = ?)');
        $stmt->bind_param('s', $spec);
        $stmt->execute();
        $result = $stmt->get_result(); ?>
            <select class="selectSpec mediumTextBlack" id="selectDoctor">
                <option hidden></option>
        <?php
        while($users = $result->fetch_assoc()){ ?>
            <option card="<?php echo $users['Card']; ?>"><?php echo $users['Fam'].' '.$users['Imya'].' '.$users['Otch']; ?></option>
    <?php } ?>
            </select>
        <?php
        $mysqli->close();
    }	
?>