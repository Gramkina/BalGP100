<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/adminLogin.php');
?>
<!DOCTYPE html>
<html><div class="wrapper">
	<head>
		<title>Отзывы</title>
		<link rel="stylesheet" type="text/css" href="css/contacts.css">
		<meta charset="utf-8">
	</head>

<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<body>
		<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/contacts/comments.php">Отзывы</a></span></div>
		<div class='content'>
			<div class="veryLargeTextBlack">Отзывы</div>
			<div class="polosaGray"><div></div></div>
			<div class="addCommentDiv">
				<?php 
				if(isset($_SESSION['user_card'])){ ?>
					<div class="mediumTextBlack">Написать отзыв</div>
					<textarea class="mediumTextBlack" id="addCommentTextarea" placeholder="Текст отзыва"></textarea>
					<div class="divSendComment"><label class="mediumTextBlue"><input id="anonCheck" type="checkbox">Анонимный отзыв</label><input id="sendButton" class="mediumTextBlack" type="button" value="Отправить"></div>
					<div id="resultComment" class="mediumTextRed"></div>
				<?php
				} else{ ?>
					<div class="mediumTextBlack addCommentFalse">Отзывы могут оставлять только <label onclick="$('#SignButtonOpen').prop('checked', 'true')" class="avtorizationURL">авторизированные</label> пользователи</div>
				<?php
				} ?>
			</div>
			<div class="comments">
			<?php
				$files = array_diff(scandir('comments'), array('.', '..'));
				$comment = array();
				foreach($files as $value){
					$comment[$value] = strtotime(explode(' ', $value, 3)[2]);
				}
				arsort($comment);
				$comment = array_keys($comment);
				for($i = 0; $i<10 && $i<count($comment); $i++){
					$info = explode(' ', $comment[$i], 3);
					$content = file_get_contents('comments/'.$comment[$i]);?>
					<div class="commentDiv">
						<div class="authorComment mediumTextBlack"><?php echo $info[0].':'; ?></div>
						<div class="textComment mediumTextBlack"><p><?php echo $content; ?></div>
						<div class="dateComment smallTextBlack"><?php echo $info[2]; ?></div>
					</div>
				<?php	
				}
			?>
			</div>
			<div class="largeTextBlue loadMoreDiv">Загрузить еще</div>
		</div>
	</body>

</div>
	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>

<script>
	$('#sendButton').click(function(){
		$.post('php/addComment.php', {comment: $('#addCommentTextarea').val(), anon: $('#anonCheck').prop('checked')}, function(result){
			if(result == 'excellent'){location.href = location.href}
			else $('#resultComment').empty().append(result);
		});
	});
	load = true;
	countComments = 10;
	$(window).on('scroll', function(){
		if($("div").is(".loadMoreDiv") && $(window).scrollTop()+$(window).height()>$('.loadMoreDiv').offset().top && load){
			load = false;
			$.post('php/loadComments.php', {countComments: countComments}, function(result){
				if(!result){ $('.loadMoreDiv').remove(); }
				else{
					$('.comments').append(result);
					countComments+=10;
					load = true;
				}
			});
		}
	});
	$('body').on('click', '.loadMoreDiv', function(){
		$.post('php/loadComments.php', {countComments: countComments}, function(result){
				if(!result){ $('.loadMoreDiv').remove(); }
				else{
					$('.comments').append(result);
					countComments+=10;
					load = true;
				}
			});
	})
</script>