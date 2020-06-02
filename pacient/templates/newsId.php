<body>
	<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/pacient">Пациентам</a> • <a href="/pacient/news.php">Новости</a></span></div>
	<div class="content">
	<div class="veryLargeTextBlack nazvanieAdministration"><?php echo $content[0]; ?></div>
		<div class="polosaGray"><div></div></div>
		<div class="newsContentId mediumTextBlack">
			<img src="<?php echo 'news/'.$files[$id].'/head.jpg'; ?>">
			<div class="newsText" news="<?php echo $files[$id]; ?>"><?php echo $content[1]; ?></div>
		</div>
	</div>
</body>

<?php if($adminOption){ ?>
	<script>
		$('.newsText').dblclick(function(){
			$.post('php/getNews.php', {news: '<?php echo $files[$id]; ?>'}, function(result){
				$('.newsContentId').empty().append('<div class="editFlexBlock"><img src="<?php echo 'news/'.$files[$id].'/head.jpg'; ?>"><div><textarea id="editNewsTextArea">'+result+'</textarea><input type="button" id="saveChangeNews" value="Сохранить"></div></div>');
			});
		});
		$('body').on('click', '#saveChangeNews', function(){
			$.post('php/saveChangeNews.php', {text: $('#editNewsTextArea').val(), news: '<?php echo $files[$id]; ?>'}, function(result){
				if(result == 'excellent') location.href = location.href;
				else alert(result);
			});
		});
	</script>
<?php } ?>