<body>
	<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/pacient">Пациентам</a> • <a href="/pacient/news.php">Новости</a></span></div>
	<div class="content">
		<div class="veryLargeTextBlack nazvanieAdministration">Новости</div>
		<div class="polosaGray"><div></div></div>
		<?php if($adminOption) echo '<div class="largeTextBlack addNews"><a href="addNews.php">Добавить новость</a></div>'; ?>
		<div class="newsContent">
		<?php
			$files = array_diff(scandir('news'), array('.', '..'));
			$news = array();
			foreach($files as $value){
				$news[$value] = strtotime($value);
			}
			arsort($news);
			$news = array_keys($news);
			for($i = 0; $i<6 && $i<count($news); $i++){
				$file = explode(PHP_EOL, file_get_contents('news/'.$news[$i].'/news'), 2);
				?>
				<div class="newsBlock">
				<a href="news.php?news=<?php echo strtotime($news[$i]);?>">
					<img src="<?php echo 'news/'.$news[$i].'/head.jpg'; ?>">
					<div>
						<div class="largeTextBlue zagolovokNews"><?php echo $file[0]; ?></div>
						<div class="mediumTextBlack previewNews"><?php echo mb_substr($file[1], 0, 100, 'UTF-8').'...'; ?></div>
						<div class="dateNews smallTextBlack"><?php echo $news[$i]; if($adminOption) echo '<img newsId="'.$news[$i].'" class="deleteNews" src="/icons/krestik.svg">';?></div>
					</div>
				</a>
				</div>					
			<?php	
			}
			?>
		</div>
		<div class="largeTextBlue loadContent"><div>Загрузить еще</div></div>
	</div>
</body>

<script>
	<?php if($adminOption){ ?>
	$('body').on('click', '.deleteNews', function(){
		$.post('php/deleteNews.php', {newsId: $(this).attr('newsId')}, function(result){
			if(result == 'excellent') location.href=location.href;
			else alert(result);
		});
	});
	<?php } ?>
	countNews = 6;
	load = true;
	$(window).on('scroll', function(){
		if($("div").is(".loadContent") && $(window).scrollTop()+$(window).height()>$('.loadContent').offset().top && load){
			load = false;
			$.post('php/loadNews.php', {numNews: countNews}, function(result){
				if(!result){ $('.loadContent').remove(); }
				else{
					$('.newsContent').append(result);
					countNews+=6;
					load = true;
				}
			});
		}
	});
	$('body').on('click', '.loadContent', function(){
		load = false;
		$.post('php/loadNews.php', {numNews: countNews}, function(result){
			if(!result){ $('.loadContent').remove(); }
			else{
				$('.newsContent').append(result);
				countNews+=6;
				load = true;
			}
		});
	})
</script>