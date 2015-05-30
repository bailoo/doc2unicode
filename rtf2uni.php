<?php
	require_once 'librtf.php';

	$rtfName = $argv[1]; 
	switch (rtfToUnicode($rtfName))
	{
		case 0:
			break;
		case 1:
			echo 'Invalid RTF File';
			exit;
		case 2:
			echo 'sed failed!';
			exit;
		case 3:
			echo 'node failed!';	
			exit;
	}

?>
