<?php

$start_time = microtime(TRUE);

define("ROOT_PATH", str_replace("\\", "/", dirname(__FILE__))."/");
define("PHP_EXT", ".php");



require_once('./includes/constants'.PHP_EXT);
require_once('./includes/functions'.PHP_EXT);

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE_SITE; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo STYLES_DIR."style".CSS_EXT; ?>" /> 
    </head>
    <body>
        <!-- menu ze strzałkami nawigacyjnymi oraz miniaturami zdjęć -->
        <div class="menu">
            <div class="nav1">
            	<a href="?page=1&img=2"><img src="<?php echo IMG_DIR."lleft_arrow".$imgExt["png"]; ?>" alt="lleft_arrow" /></a>
            </div>
            <div class="nav2">
            	<?php if (!isPrevPage()) : ?>
            	<a href="?page=<?php echo $page; ?>&img=<?php echo $img; ?>"><img src="<?php echo IMG_DIR."left_arrow".$imgExt["png"]; ?>" alt="left_arrow" /></a>
            	<?php else : ?>
            	<a href="?page=<?php echo $page - 1; ?>&img=<?php echo $img; ?>"><img src="<?php echo IMG_DIR."left_arrow".$imgExt["png"]; ?>" alt="left_arrow" /></a>
            	<?php endif; ?>	
            </div>
            
            <?php for ($i = 0; $i < IMG_PER_PAGE; ++$i) : ?>
            <div class="small_image">
            	
            <?php
            	$tab = getFiveImages($page);
				if ($tab[$i] == true) :
			?>
            	<a href="?page=<?php echo $page; ?>&img=<?php echo calcNoImage($page) + $i; ?>"><img src="<?php echo PICTURES_DIR.$tab[$i]; ?>" alt="<?php echo $tab[$i]; ?>" /></a>
            <?php else : ?>
            	<a href="#"><img src="<?php echo IMG_DIR."no-image".$imgExt["png"]; ?>" alt="no-image" /></a>
            <?php endif; ?>		
            </div>
            <?php endfor; ?>
            
            <div class="nav2">
            	<?php if (!isNextPage()) : ?>
            	<a href="?page=<?php echo $page; ?>&img=<?php echo $img; ?>"><img src="<?php echo IMG_DIR."right_arrow".$imgExt["png"]; ?>" alt="right_arrow" /></a>
            	<?php else : ?>
            	<a href="?page=<?php echo $page + 1; ?>&img=<?php echo $img; ?>"><img src="<?php echo IMG_DIR."right_arrow".$imgExt["png"]; ?>" alt="right_arrow" /></a>
            	<?php endif; ?>
            </div>
            <div class="nav1">
            	<a href="?page=<?php echo getNoPages(); ?>&img=<?php echo getNoImages() + 1; ?>"><img src="<?php echo IMG_DIR."rright_arrow".$imgExt["png"]; ?>" alt="rright_arrow" /></a>
            </div>
            
            <div style="float: none;"></div>
        </div>
        <!-- koniec menu -->
        <?php
        	if ($img ==1)
			{
				$img = 2;
			}
			
			$image = getImage($img);
		?>     
        
        <!-- informacje o pliku graficznym -->
        <div class="info_header">
            <div class="img_info">Nazwa: <?php echo $image ? $image["name"] : "---" ?></div>
            <div class="img_info">Waga: <?php echo $image ? getSizeImage($img) : "0 B" ?></div>
            <div class="img_info">Rozmiar: <?php echo $image ? $image["real_width"]."x".$image["real_height"] : "---" ?></div>
            
            <div style="float: none;"></div>
        </div>
        <!-- koniec info -->
        
                      
                
        <!-- duże zdjęcie -->
        <div class="big_image" style="height: <?php echo $image ? $image["height"] : 200; ?>px; width: <?php echo $image ? $image["width"] : 200; ?>px">
        <?php
        	if ($image !== false)
			{
				echo '<img src="'.PICTURES_DIR.$image["name"].'" alt="'.$image["name"].'" style="height: '.$image["height"].'px; width: '.$image["width"].'px;" />';
			}
			else 
			{
				echo '<img src="'.IMG_DIR.'no-image'.$imgExt["png"].'" alt="no-image" style="height: 200px; width: 200px;" />';
			}
		?>
        </div>
        <!-- koniec dużego zdjęcia -->
               
        <?php
        $stop_time = microtime(true);
		$render_time = getRenderTime($stop_time - $start_time, 4);
        ?>
        
        <!-- stopka -->
        <div class="footer">
            <p>&copy; Copyright Kamil 2017<br /><br />Wyrenderowano w <?php echo $render_time ?> sekund</p>
        </div>
        <!-- koniec stopki -->
        
    </body>
</html>