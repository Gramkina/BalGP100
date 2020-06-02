<?php
	require($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/adminLogin.php');
?>
<!DOCTYPE html>
<html><div class="wrapper">
	<head>
		<title>Пациентам - Новости</title>
		<link rel="stylesheet" type="text/css" href="css/pacient.css">
		<meta charset="utf-8">
	</head>
<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<?php 
		if(!isset($_GET['news'])){
			require_once('templates/defaultNews.php');
		}
		else{
			$newsGET = date('d.m.Y H:i', $_GET['news']);
			$files = array_diff(scandir('news'), array('.', '..'));
			if($id = array_search($newsGET, $files)){
				$content = explode(PHP_EOL, file_get_contents($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.$files[$id].'/news'), 2);
				require_once('templates/newsId.php');
			}
			else require_once('templates/defaultNews.php');
		}
	?>

</div>

	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>