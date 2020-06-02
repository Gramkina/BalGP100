<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT Content FROM Zapisi WHERE Card = ? AND Id = ?');
        $stmt->bind_param('ii', $_SESSION['user_card'], $_POST['Id']);
        $stmt->execute();
        $zapisi = $stmt->get_result()->fetch_assoc()['Content'];
        ?>
        <div class="posolaRecept"></div>
        <div>
            <div class="mediumTextBlack">Рецепт</div>
            <div class="receptText"><?php echo $zapisi; ?></div>
        </div>
        <?php
    }
?>