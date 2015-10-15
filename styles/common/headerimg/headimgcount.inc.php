<?php

	$filecount=0;
	$dir="styles/common/headerimg";
	$dirh=opendir($dir);
	while($filename=readdir($dirh))
		{
		if($filename!="." && $filename!=".." && is_file($dir."/".$filename)){
				$filecount++;
			}
		}
	closedir($dirh);
	$filecountnew = $filecount - 3;
	$HEAD_IMG_COUNT = $filecountnew;

?>