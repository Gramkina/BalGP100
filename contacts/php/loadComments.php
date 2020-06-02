<?php
	$countComments = $_POST['countComments'];
    $files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/contacts/comments'), array('.', '..'));
	$comment = array();
	foreach($files as $value){
			$comment[$value] = strtotime(explode(' ', $value, 3)[2]);
	}
	arsort($comment);
	$comment = array_keys($comment);
    for($i = $countComments; $i<$countComments+10 && $i<count($comment); $i++){
        $info = explode(' ', $comment[$i], 3);
		$content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/contacts/comments/'.$comment[$i]);?>
			<div class="commentDiv">
				<div class="authorComment mediumTextBlack"><?php echo $info[0].':'; ?></div>
				<div class="textComment mediumTextBlack"><p><?php echo $content; ?></div>
				<div class="dateComment smallTextBlack"><?php echo $info[2]; ?></div>
			</div>
        </div>					
    <?php	
    }
?>
