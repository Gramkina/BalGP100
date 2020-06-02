<?php
	require($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/adminLogin.php');
	if($adminOption){
?>

<html><div class="wrapper">
	<head>
		<title>Пациентам - Новости</title>
		<link rel="stylesheet" type="text/css" href="css/pacient.css">
		<meta charset="utf-8">
	</head>
	
	<!--        HEADER          -->
	<div>
		<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

		<body>
			<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/pacient">Пациентам</a> • <a href="/pacient/news.php">Новости</a></span></div>
			<div class="content">
				<div class="veryLargeTextBlack nazvanieAdministration">Добавить новость</div>
				<div class="polosaGray"><div></div></div>
				<div class="mediumTextBlack">Заголовок новости</div>
				<input id="zagolovok" class="mediumTextBlack zagolovokAddNews" type="text">
				<div class="mediumTextBlack">HTML текст</div>
				<textarea id="htmlText" class="mediumTextBlack htmlNewsAdd"></textarea>
				<div class="htmlNewsAddBottom">
					<div>
						<div class="mediumTextBlack">Фото заголовка</div>
						<input class="mediumTextBlack" id="photoZag" type="file">
					</div>
					<input class="mediumTextBlack" type="button" id="addNewsButton" value="Добавить">
				</div>
			</div>
		</body>
	</div>

	<script>
		$('#addNewsButton').click(function(){
			formData = new FormData();
			formData.append('photo', $('#photoZag').prop('files')[0]);
			formData.append('zagolovok', $('#zagolovok').val());
			formData.append('htmlText', $('#htmlText').val());
			$.ajax({
				url: 'php/addNews.php',
				dataType: 'text',
				data: formData,
				contentType: false,
				processData: false,
				type: 'post',
				success: function(result){
					alert(result);
				}
			});
		});
	</script>

	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
	
</div></html>

<?php 
}
else echo 'Access is denied';
?>