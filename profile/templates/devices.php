<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');?>
<div class="newContent">
    <?php 
        use phpbrowscap\Browscap;
        require_once($_SERVER['DOCUMENT_ROOT'].'/library/php/Browscap.php');
        $bb = new Browscap($_SERVER['DOCUMENT_ROOT']);

        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT * FROM tokens WHERE Card = ?');
        $stmt->bind_param("i", $_SESSION['user_card']);
        $stmt->execute();
        $result = $stmt->get_result();
        while($array = $result->fetch_assoc()){ 
            $browserData = $bb->getBrowser($array['user_agent'], true);
            ?>
            <div style="width: 100%; height: 80px; background: #DADADB; margin-bottom: 20px; box-sizing:border-box; padding: 5px; display: flex;">
                <div style="width: 10%; height: 100%; display: flex; align-items:center; justify-content:center;">
                    <img src="<?php echo $browserData['isMobileDevice'] == '1' ? '/icons/phone_icon.svg" width=40%' : '/icons/computer_icon.svg" width=80%' ?>">
                </div>
                <div style="width:100%; display: flex;">
                    <div style="width: 30%; height: 100%; display: flex; flex-direction:column; justify-content:space-around; padding: 10px 0; box-sizing:border-box; padding-left: 10px;">
                        <div class="mediumTextBlack">IP-адресс: <?php echo $array['IP']; ?></div>
                    </div>
                    <div style="width: 20%; height: 100%; display: flex; align-items:center; justify-content:center;" class="mediumTextBlack">
                        <?php echo $browserData['Browser']; ?>
                    </div>
                    <div style="width: 25%; height: 100%; display: flex; align-items:center; flex-direction:column; justify-content:space-around; padding: 10px 0; box-sizing:border-box;">
                        <div class="mediumTextBlack">Последнее посещение</div>
                        <div class="mediumTextBlack"><? echo date('d.m в H:i', $array['time'] - (60*60*24*7)); ?></div>
                    </div>
                    <div style="width: 25%; height: 100%; display: flex; align-items:center; justify-content:center; cursor: pointer;" class="mediumTextBlue removeDevice" token="<?php echo $array['token']; ?>" series="<?php echo $array['series']; ?>">
                        Завершить сеанс
                    </div>
                </div>
            </div>
        <?php } ?>
</div>

<script src="js/deleteDevice.js"></script>