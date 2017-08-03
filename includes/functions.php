<?php

$page = "";
$img = "";
getParams($page, $img);

 $img_array = array();
 getImages($img_array);


function getRenderTime($time, $dec = 0)
{
	return number_format($time, $dec, ".", " ");
}

function getParams(&$page, &$img)
{
	$page = filter_input(INPUT_GET, "page") ? filter_input(INPUT_GET, "page") : "1";
	$img  = filter_input(INPUT_GET, "img") ? filter_input(INPUT_GET, "img") : "1";
}

function getImages(&$img_array)
{
	$img_array = array_diff(scandir(ROOT_PATH.PICTURES_DIR), array(".", ".."));
}

function getNoImages()
{
	global $img_array;
	
	return count($img_array);
}

function getNoPages()
{
	global $img_array;
	
	return ceil(count($img_array)/IMG_PER_PAGE);
}
  function isNextPage()
  {
  	global $page;
	
	return $page + 1 > getNoPages() ? false : true;
  }
  
  function isPrevPage()
  {
  	global $page;
	
	return $page - 1 < 1 ? false : true;
  }
  
   function calcNoImage($no_page)
   {
   	return $no_page == 1 ? $no_page + 1 : ($no_page - 1)*IMG_PER_PAGE +2;
   }
   
   function getImage($no_img)
   {
   	global $img_array;
	
	if (!isset($img_array[$no_img]))
	{
		return false;
	}
	
	$img["name"] = $img_array[$no_img];
	
	list($img_width, $img_height) = getimagesize(ROOT_PATH.PICTURES_DIR.$img_array[$no_img]);
	
	$img["real_width"] = $img_width;
	$img["real_height"] = $img_height;
	
	if ($img_width > 3000 && $img_height > 3000)
	{
		$img["width"] = round($img_width*0.25);
		$img["height"] = round($img_height*0.25);
	}
	else if ($img_width > 1500 && $img_height > 1500)
	{
		$img["width"] = round($img_width*0.4);
		$img["height"] = round($img_height*0.4);
	}
	else 
	{
		$img["width"] = round($img_width*0.4);
		$img["height"] = round($img_height*0.4);
	}
	
	return $img;
   }
   
   function getFiveImages($no_page)
   {
   		global $img_array;
		
		if ($no_page > getNoPages())
		{
			$no_page = getNoPages();
		}
		
		if ($no_page < 1)
		{
			$no_page = 1;
		}
		
		$tmp = ($no_page - 1) * IMG_PER_PAGE;
		for ($i = $tmp + 2; $i < $tmp + IMG_PER_PAGE + 2; ++$i)
		{
			if (isset($img_array[$i]))
			{
				$_img [] = $img_array[$i];
			}
			else 
			{
				$_img [] = false;	
			}
		}
		
		return $_img;
   }
   
   function getSizeImage($no_img)
   {
   		global $img_array;
		
		return floatToString(filesize(ROOT_PATH.PICTURES_DIR.$img_array[$no_img]));
   }
   
   function floatToString($number)
   {
   		$length = strlen(sprintf("%.0f", $number));
		
		$kilo = 1024.0;
		$mega = $kilo * 1024.0;
		
		if ($length < 4)
		{
			return pretty_number($number)." B";
		}
		else if ($length < 7)
		{
			return pretty_number($number/$kilo, 1)." kB";
		}
		else 
		{
			return pretty_number($number/$mega, 1)." MB";
		}
   }
   
   function pretty_number($number, $dec = 0)
   {
   		return getRenderTime($number, $dec);
   }

   
   
   
   
   
   