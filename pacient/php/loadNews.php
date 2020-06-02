<?php
    $numNews = $_POST['numNews'];
    $files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'), array('.', '..'));
    $news = array();
    foreach($files as $value){
        $news[$value] = strtotime($value);
    }
    arsort($news);
    $news = array_keys($news);
    for($i = $numNews; $i<$numNews+6 && $i<count($news); $i++){
        $file = explode(PHP_EOL, file_get_contents($_SERVER['DOCUMENT_ROOT'].'/pacient/news/'.$news[$i].'/news'), 2);
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
