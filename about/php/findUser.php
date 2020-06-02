<?php
    session_start();
    if(isset($_SESSION['user_card'])){
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $result = $mysqli->query('SELECT * FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc();
        if($result['RankNumber'] == 10){
            $card = $_POST['card'];
            $stmt = $mysqli->prepare('SELECT * FROM Users WHERE Card = ?') or die('Ошибка');
            $stmt->bind_Param('i', $card) or die('Ошибка');
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if($result){
                echo '<div class="addUserContentTrue">
                <div class="infoAddUser">
                    <img src="/avatarUsers/'.($result['Avatar'] != null ? $result['Avatar'] : 'noAvatar.svg').'" class="addUserAvatar">
                    <div class="mediumTextBlack">'.$result['Fam'].' '.$result['Imya'].' '.$result['Otch'].'</div>
                </div>
                <div class="addUserZaplonInfo">
                    <div class="mediumTextBlack">Введите должность</div>
                    <div class="fullInputBlockReg">
                        <div class="inputBlockReg">
                            <div class="inputBlockRegistration">
                                <div class="iconInputBlockReg">
                                    <img src="/icons/stethoscope.svg">
                                </div>
                                <input id="rank" class="inputInputBlockReg" type="text" placeholder="Должность">
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 10px;" class="mediumTextBlack">Введите номер должности</div>
                    <div class="fullInputBlockReg">
                        <div class="inputBlockReg">
                            <div class="inputBlockRegistration">
                                <div class="iconInputBlockReg">
                                    <img src="/icons/stethoscope.svg">
                                </div>
                                <input id="rankNumber" class="inputInputBlockReg" type="text" placeholder="Номер">
                            </div>
                        </div>
                    </div>
                    <input id="addDoctorButton" type="button" style="margin-top: 10px;" class="mediumTextBlack" value="Добавить">
                    <div id="resultAddDoctor" class="mediumTextBlack"></div>
                    <ul class="mediumTextBlack">
                        <li>1 - Главный врач</li>
                        <li>2 - Сотрудник гл. врача</li>
                        <li>3 - Врач</li>
                        <li>10 - Админ</li>
                    </ul>
                </div>
            </div>';
            }
            else echo '<div class="mediumTextBlack">Пользователь не найден</div>';
        }
        else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
        $mysqli->close();
    }
    else echo '<div class="mediumTextBlack">У вас недостаточно прав.</div>';
?>