<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');?>
<div class="newContent">
    <div class="selectZapis mediumTextBlack">
        <input type="radio" id="zapisiRadio" name="chooseZapisi" checked hidden>
        <label for="zapisiRadio" class="zapRad">Записи</label>
        <input type="radio" id="historyRadio" name="chooseZapisi" hidden>
        <label for="historyRadio" class="hisRad">История</label>
    </div>
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT RankNumber FROM Doctors WHERE Card = ?');
        $stmt->bind_param('i', $_SESSION['user_card']);
        $stmt->execute();
        $vr = $stmt->get_result()->fetch_assoc();
        if($vr && ($vr['RankNumber'] == '1' || $vr['RankNumber'] == '3')){ ?>
            <input type="radio" id="doctorRadio" name="chooseZapisi" hidden>
            <label for="doctorRadio" class="zapisDoctorOption mediumTextBlack">Режим врача</label>
        <?php
        }
        ?>
    <div style="margin-top: 20px"></div>
    <div class="result">
    <?php
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
    ?>
    </div>
</div>

<script>
    $('#historyRadio').change(function(){
        $.post('php/getHistoryClient.php', function(result){
            $('.result').empty().append(result);
        })
    });
    $('#zapisiRadio').change(function(){
        $.post('php/getZapisiClient.php', function(result){
            $('.result').empty().append(result);
        })
    });
    $('#doctorRadio').change(function(){
        $.post('php/getDoctorClient.php', function(result){
            $('.result').empty().append(result);
        })
    });
    $('body').on('click', '.acceptRecept', function(){
        recept = $(this).parent().children('textarea').val();
        id = $(this).parent().attr('idzapisRecept');
        $.post('php/saveReceptClient.php', {content: recept, id: id}, function(){
        });
    });
    $('body').on('click', '.zapisDiv', function(){
        block = this;
        id = $(this).attr('idzapis');
        $.post('php/getContentZapisi.php', {Id: id}, function(result){
            $(block).children('.recept').empty().append(result);
        });
    });
</script>