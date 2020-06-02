<?php
	require($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
?>

<html><div class="wrapper">
	<head>
		<title>Главная</title>
		<link rel="stylesheet" type="text/css" href="/css/index.css">
		<meta charset="utf-8">
	</head>
	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<body>
		<div class="content">
			<div class="slider">
				<div class="left"><?php include($_SERVER['DOCUMENT_ROOT'].'/icons/arrowSlider.svg');?></div>
				<img class="sliderImage" src="/slider/title.svg">
				<div class="right"><?php include($_SERVER['DOCUMENT_ROOT'].'/icons/arrowSlider.svg');?></div>
			</div>
			<div class="infoTimeIndex">
				<div class="timeWork">
					<div class="largeTextWhite">Время работы</div>
					<div class="timeWorkText">
						<div class="mediumTextWhite">ПН - ПТ</div>
						<div class="mediumTextWhite">8:30 - 20:30</div>
					</div>
					<div class="lineTimeWork"></div>
					<div class="timeWorkText">
						<div class="mediumTextWhite">СБ - ВС</div>
						<div class="mediumTextWhite">НЕ  РАБОТАЕТ</div>
					</div>
					<div class="lineTimeWork"></div>
				</div>
				<div class="zapis">
					<div class="largeTextWhite">Запись на прием</div>
					<div id="zapisTextIndex" class="mediumTextWhite">Разнообразный и богатый опыт постоянное информационно-пропагандистское обеспечение  форм развития</div>
					<div class="zapisBottomIndex"><a href="/pacient/zapis.php" class="mediumTextWhite zapisIndexPod">Записаться</a></div>
				</div>
			</div>
			<div class="largeTextBlack nazvanieAdministration">Наша поликлиника</div>
			<div class="polosaGray"><div></div></div>
			<div id="indexAbout" class="mediumTextBlack">
				<img src="/image/photoPolik.jpg">
				<div>Повседневная практика показывает, что дальнейшее развитие различных форм деятельности представляет собой интересный эксперимент проверки форм развития. Таким образом сложившаяся структура организации позволяет оценить значение дальнейших направлений развития.
					<ul>
						<li>Повседневная практика показывает</li>
						<li>Повседневная практика показывает</li>
						<li>Повседневная практика показывает</li>
						<li>Повседневная практика показывает</li>
						<li>Повседневная практика показывает</li>
					</ul>
				</div>
			</div>
			<div class="largeTextBlack nazvanieAdministration">Новости</div>
			<div class="polosaGray"><div></div></div>
			<div class="blockNews">
				<div class="contentBlockNews">
					<?php
					$files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/pacient/news'), array('.', '..'));
					$news = array();
					foreach($files as $value){
						$news[$value] = strtotime($value);
					}
					arsort($news);
					$news = array_keys($news);
					for($i = 0; $i<4 && $i<count($news); $i++){
						$file = explode(PHP_EOL, file_get_contents($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.$news[$i].'/news'), 2);
						?>
						<div class="newsBlock">
						<a href="/pacient/news.php?news=<?php echo strtotime($news[$i]);?>">
							<img src="<?php echo '/pacient/news/'.$news[$i].'/head.jpg'; ?>">
							<div>
								<div class="mediumTextBlue zagolovokNews"><?php echo $file[0]; ?></div>
								<div class="smallTextBlack previewNews"><?php echo mb_substr($file[1], 0, 100, 'UTF-8').'...'; ?></div>
								<div class="dateNews smallTextBlack"><?php echo $news[$i]; ?></div>
							</div>
						</a>
						</div>					
					<?php	
					}
					?>
				</div>
				<div class="moreNews mediumTextBlue"><a href="/pacient/news.php">Больше новостей</a></div>
			</div>
		</div>
	</body>	

	<script>
		photo = 0;
		pics = ['title.svg'<?php $files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/slider'), array('.', '..', 'title.svg')); foreach($files as $value){ echo ", '$value'"; } ?>]
		buttonSlider = true;
		$(function(){
			$('body').on('click', '.left', function(){
				if(buttonSlider){
					buttonSlider = false;
					clearInterval(changeTimer);
					if(--photo < 0) photo=pics.length-1;
					$('.sliderImage').removeClass('sliderChangeEnding').addClass('sliderChange');
					setTimeout(function(){
						$('.sliderImage').attr('src', '/slider/'+pics[photo]);
						$('.sliderImage').removeClass('sliderChange').addClass('sliderChangeEnding');
						changeTimer = setInterval(changeImage, 7000);
						buttonSlider = true;
					}, 800);
				}
			});
			$('body').on('click', '.right', function(){
				if(buttonSlider){
					buttonSlider = false;
					clearInterval(changeTimer);
					if(++photo > pics.length-1) photo=0;
					$('.sliderImage').removeClass('sliderChangeEnding').addClass('sliderChange');
					setTimeout(function(){
						$('.sliderImage').attr('src', '/slider/'+pics[photo]);
						$('.sliderImage').removeClass('sliderChange').addClass('sliderChangeEnding');
						changeTimer = setInterval(changeImage, 7000);
						buttonSlider = true;
					}, 800);
				}
			});
			changeTimer = setInterval(changeImage, 7000);
			function changeImage(){
				if(++photo > pics.length-1) photo = 0;
				$('.sliderImage').removeClass('sliderChangeEnding').addClass('sliderChange');
				setTimeout(function(){
					$('.sliderImage').attr('src', '/slider/'+pics[photo]);
					$('.sliderImage').removeClass('sliderChange').addClass('sliderChangeEnding');
				}, 800);
			}
		});
	</script>

	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>