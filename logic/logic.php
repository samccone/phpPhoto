<?php

//THIS IS SCARY DONT TOUCH UNLESS YOU KNOW WHAT YOU ARE DOING

$galleries = array();
function get_images()
{
	global $galleries;
	
	$firstGallery =	getFirstDirectory();
	$currently_at = $_GET['gallery'];
	if($currently_at == '' || !(in_array($_GET['gallery'],$galleries))) $currently_at="galleries/$firstGallery";
	else $currently_at = "galleries/".$currently_at;
	

	$directoy = opendir($currently_at);
	$files	=	array();
	while (false !== ($file = readdir($directoy))) 
	{
		if($file[0]!='.')
		{
			array_push($files,$file);
		}
	}
	
	sort($files);
	for($i=0;$i<sizeof($files);$i++)
	{
		$file = $files[$i];
			if(pathinfo($file, PATHINFO_EXTENSION)=="html")
			{
				$filename = "$currently_at/$file"; 
				$handle = fopen ($filename, "r"); 
				$contents = fread ($handle, filesize ($filename)); 
				fclose ($handle); 
				print "<div class='html_contents'>$contents</div>"; 
			}
			else
			{
				try
				{
					$meta = exif_read_data("$currently_at/$directory_name/$file");
				}
				catch(Exception $e)
				{
					$meta=array('ImageDescription'=>"");
				}
			
				$caption = $meta["ImageDescription"];
			
				print "<div class='image_wrap'>
				 	   <img class='gallery_image' src='$currently_at/$directory_name/$file'/>
					   <div class='image_caption'>$caption</div>
					  </div>";
			}
	}
	
		
}

function get_directories()
{
	global $galleries;
	
	$currently_at = $_GET['gallery'];
	$loadFirst = $currently_at == '' ? true : false;
	
	$directoy = opendir("galleries");
	$position = 1;
	$files = array();
	while (false !== ($file = readdir($directoy))) 
	{
		if($file[0]!='.')
		{
			array_push($files,$file);
		}
	 }
	sort($files);
	
	for($i=0;$i<sizeof($files);$i++)
	{
		$file		=	$files[$i];
		$fileName	=	explode('_',$file);
		
		
		$activeStatus		=	($currently_at!=$file) ? 'inactive' : 'active';
		$activeStatus       =   ($loadFirst&&$position==1) ? 'active' : 'inactive';
		 
		$activeStatus		=	$currently_at==$file ? 'active' : $activeStatus;
 		
		print "<div class='menu_item menu_$position'><a class='menu_link $activeStatus' href='index.php?gallery=$file'>".$fileName[1]."</a></div>";
		array_push($galleries,$file);
		$position++;
	}
}


function getFirstDirectory()
{
	$directoy = opendir("galleries");
	while (false !== ($file = readdir($directoy))) 
	{
		if($file[0]!='.')
		{
			 return $file;
		}
	}
}
function get_current_gallery_name()
{
	$fileName	=	explode('_',$_GET['gallery']);
	$toPrint	=	sizeof($fileName)==2 ? $fileName[1] : $fileName[0];
	echo $toPrint;
}

?>
