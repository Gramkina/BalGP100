<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(isset($_SESSION['user_card'])){
        $doctor = $_POST['doctor'];
        $date = strtotime($_POST['date']);

        $oneDay = 60*60*24;
        $dateNedDay = date('N', $date)-1;
        $dateA = date('d.m.Y', $date-($dateNedDay*$oneDay));
        $dateB = date('d.m.Y', $date+((4 - $dateNedDay)*$oneDay));
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
        $mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        $stmt = $mysqli->prepare('SELECT Date, Time FROM Zapisi WHERE Doctor = ? AND Date BETWEEN ? AND ?');
        $stmt->bind_param('iss', $doctor, $vrDateA = date('Y-m-d', strtotime($dateA)), $vrDateB = date('Y-m-d', strtotime($dateB)));
        $stmt->execute();
        $zapisi = $stmt->get_result()->fetch_all();
        $stmt = $mysqli->prepare('SELECT Date, Time FROM vr_zapisi WHERE Doctor = ? AND Date BETWEEN ? AND ?');
        $stmt->bind_param('iss', $doctor, $vrDateA = date('Y-m-d', strtotime($dateA)), $vrDateB = date('Y-m-d', strtotime($dateB)));
        $stmt->execute();
        foreach($stmt->get_result()->fetch_all() as $arr){
            array_push($zapisi, $arr);
        }
        $stmt = $mysqli->prepare('SELECT * FROM Raspisanie WHERE Card = ?');
        $stmt->bind_param('i', $doctor);
        $stmt->execute();
        $raspisanie = $stmt->get_result()->fetch_assoc();
        ?>
        <div class="viborNedeli"><div class="predNedel mediumTextWhite">Предыдущая неделя</div><div class="nextNedel mediumTextWhite">Следующая неделя</div></div>
        <table class="tableRaspisanie mediumTextBlack">
			<tr>
				<td><div><div><?php echo date('d.m', strtotime($dateA)); ?></div><div>Понедельник</div></div></td>
				<td><div><div><?php echo date('d.m', strtotime($dateA)+$oneDay); ?></div><div>Вторник</div></div></td>
				<td><div><div><?php echo date('d.m', strtotime($dateA)+2*$oneDay); ?></div><div>Среда</div></div></td>
				<td><div><div><?php echo date('d.m', strtotime($dateA)+3*$oneDay); ?></div><div>Четверг</div></div></td>
				<td><div><div><?php echo date('d.m', strtotime($dateA)+4*$oneDay); ?></div><div>Пятница</div></div></td>
			</tr>
        <?php   
        $i = 0;
        while(($raspisanie['Monday'] != null && strtotime(($time1 = explode('-', ($raspisanie['Monday'])))[0])+15*60*$i < strtotime($time1[1])) ||
              ($raspisanie['Tuesday'] != null && strtotime(($time2 = explode('-', ($raspisanie['Tuesday'])))[0])+15*60*$i < strtotime($time2[1])) ||
              ($raspisanie['Wednesday'] != null && strtotime(($time3 = explode('-', ($raspisanie['Wednesday'])))[0])+15*60*$i < strtotime($time3[1])) ||
              ($raspisanie['Thursday'] != null && strtotime(($time4 = explode('-', ($raspisanie['Thursday'])))[0])+15*60*$i < strtotime($time4[1])) ||
              ($raspisanie['Friday'] != null && strtotime(($time5 = explode('-', ($raspisanie['Friday'])))[0])+15*60*$i < strtotime($time5[1])) ){ 
             ?>
			<tr>
                <?php echo ($raspisanie['Monday'] && ($vr = strtotime(($time1 = explode('-', ($raspisanie['Monday'])))[0])+15*60*$i) < strtotime($time1[1])) ? '<td><div class="'.(in_array(array(date('Y-m-d', strtotime($dateA)), date('H:i:s', $vr)), $zapisi) || strtotime($dateA) < time() ? 'occupedTimeRaspisanieDiv' : 'selectTimeRaspisanieDiv').'" date="'.date('Y.m.d', strtotime($dateA)).'" time="'.date('H:i', $vr).'">'.date('H:i', $vr).'</div></td>' : (!$raspisanie['Monday'] ? ($i == 0 ? '<td class="largeTextRed" rowspan="50"><div class="netPriema">Нет приема</div></td>' : '') : '<td></td>'); ?>
                <?php echo ($raspisanie['Tuesday'] && ($vr = strtotime(($time2 = explode('-', ($raspisanie['Tuesday'])))[0])+15*60*$i) < strtotime($time2[1])) ? '<td><div class="'.(in_array(array(date('Y-m-d', strtotime($dateA)+$oneDay), date('H:i:s', $vr)), $zapisi) || strtotime($dateA)+$oneDay < time() ? 'occupedTimeRaspisanieDiv' : 'selectTimeRaspisanieDiv').'" date="'.date('Y.m.d', strtotime($dateA)+$oneDay).'" time="'.date('H:i', $vr).'">'.date('H:i', $vr).'</div></td>' : (!$raspisanie['Tuesday'] ? ($i == 0 ? '<td class="largeTextRed" rowspan="50"><div class="netPriema">Нет приема</div></td>' : '') : '<td></td>'); ?>
                <?php echo ($raspisanie['Wednesday'] && ($vr = strtotime(($time3 = explode('-', ($raspisanie['Wednesday'])))[0])+15*60*$i) < strtotime($time3[1])) ? '<td><div class="'.(in_array(array(date('Y-m-d', strtotime($dateA)+2*$oneDay), date('H:i:s', $vr)), $zapisi) || strtotime($dateA)+2*$oneDay < time() ? 'occupedTimeRaspisanieDiv' : 'selectTimeRaspisanieDiv').'" date="'.date('Y.m.d', strtotime($dateA)+2*$oneDay).'" time="'.date('H:i', $vr).'">'.date('H:i', $vr).'</div></td>' : (!$raspisanie['Wednesday'] ? ($i == 0 ? '<td class="largeTextRed" rowspan="50"><div class="netPriema">Нет приема</div></td>' : '') : '<td></td>'); ?>
                <?php echo ($raspisanie['Thursday'] && ($vr = strtotime(($time4 = explode('-', ($raspisanie['Thursday'])))[0])+15*60*$i) < strtotime($time4[1])) ? '<td><div class="'.(in_array(array(date('Y-m-d', strtotime($dateA)+3*$oneDay), date('H:i:s', $vr)), $zapisi) || strtotime($dateA)+3*$oneDay < time() ? 'occupedTimeRaspisanieDiv' : 'selectTimeRaspisanieDiv').'" date="'.date('Y.m.d', strtotime($dateA)+3*$oneDay).'" time="'.date('H:i', $vr).'">'.date('H:i', $vr).'</div></td>' : (!$raspisanie['Thursday'] ? ($i == 0 ? '<td class="largeTextRed" rowspan="50"><div class="netPriema">Нет приема</div></td>' : '') : '<td></td>'); ?>
                <?php echo ($raspisanie['Friday'] && ($vr = strtotime(($time5 = explode('-', ($raspisanie['Friday'])))[0])+15*60*$i) < strtotime($time5[1])) ? '<td><div class="'.(in_array(array(date('Y-m-d', strtotime($dateA)+4*$oneDay), date('H:i:s', $vr)), $zapisi) || strtotime($dateA)+4*$oneDay < time() ? 'occupedTimeRaspisanieDiv' : 'selectTimeRaspisanieDiv').'" date="'.date('Y.m.d', strtotime($dateA)+4*$oneDay).'" time="'.date('H:i', $vr).'">'.date('H:i', $vr).'</div></td>' : (!$raspisanie['Friday'] ? ($i == 0 ? '<td class="largeTextRed" rowspan="50"><div class="netPriema">Нет приема</div></td>' : '') : '<td></td>'); ?>
			</tr>
    <?php $i++;
            } ?>
        </table>
    <?php
        $mysqli->close();
    }	
?>