<?php

	require_once 'rtfclass.php';


//turn on php error reporting
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$name     = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$error    = $_FILES['file']['error'];
	$size     = $_FILES['file']['size'];
    	$ext	  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  
	switch ($error) {
		case UPLOAD_ERR_OK:
			$valid = true;
			//validate file extensions
			if ( !in_array($ext, array('rtf')) ) {
				$valid = false;
				$response = 'Only rtf file supported';
			}
			//validate file size
			if ( $size/1024/1024 > 2 ) {
				$valid = false;
				$response = 'File size is exceeding maximum allowed size 1MB';
			}
			//upload file
			if ($valid) {
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
				move_uploaded_file($tmpName,$targetPath); 
				Ted2Uni($targetPath);
				header( 'Location: index.php' ) ;
				exit;
			}
			break;
		case UPLOAD_ERR_INI_SIZE:
			$response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			break;
		case UPLOAD_ERR_PARTIAL:
			$response = 'The uploaded file was only partially uploaded.';
			break;
		case UPLOAD_ERR_NO_FILE:
			$response = 'No file was uploaded.';
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
			break;
		default:
			$response = 'Unknown error';
		break;
	}

	echo $response;

}

	/* convert rtf to unicode text */
	/* 	*/
	/* 	*/
	/* 	*/
	/* 	*/
	/* 	*/

	function rtf2Uni($rtfName)
	{
		$rtfFile = fopen($rtfName,"r");
		$data = fread($rtfFile,filesize($rtfName));
		fclose($rtfFile);
		$r = new rtf($data);
		$r->output("text");
		$r->parse();
		$uniName = dirname($rtfName) .'/'. basename($rtfName,".rtf") . ".txt";
		$uniFile = fopen($uniName, "w") or die("Unable to open file");
		fwrite($uniFile,$r->out);	
		fclose($uniFile);
	}

	/* convert rtf to txt using Ted */
	/*	*/
	/*	*/
	/*	*/
	/*	*/
	
	function Ted2Uni($rtfName)
	{
		$txtName = dirname($rtfName) .'/'. basename($rtfName,".rtf") . ".txt";
		exec("/usr/bin/Ted --saveTo " .$rtfName. " " .$txtName);
	}
?>
