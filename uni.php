<?php
/*
Template Name: uni 
 *
 * @package WordPress
 * @subpackage WPDvlpr_Tools 
 * @since WPDvlpr Tools 1.0
 *
*/
get_header();

?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<form class="well" action="<?php the_permalink(); ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="file">Select an RTF file to upload</label>
					<input type="file" name="file">
				</div>
				<input type="submit" name="submit" class="button" value="Upload">
			</form>
    	
<?php 

require_once 'librtf.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$uploadedfile = $_FILES['file'];	
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
				$response = 'Only RTF file supported';
				echo $response;
				exit;
			}
			//validate file size
			if ( $size/1024/1024 > 2 ) {
				$valid = false;
				$response = 'File size is exceeding maximum allowed size 1MB';
				echo $response;
				exit;
			}
			//upload file
			if ($valid) {
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
				move_uploaded_file($tmpName,$targetPath);
				switch (rtfToUnicode($targetPath))
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
				break;
				//$upload_overrides = array( 'test_form' => false );
				//$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
				//if ( $movefile ) {
				//	var_dump($movefile);
					//header( 'Location: index.php' ) ;
					//exit;
				//} else {
				//	echo $movefile['error'];
				//}
			}
			break;
		case UPLOAD_ERR_INI_SIZE:
			$response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			echo $response;
			exit;
			//break;
		case UPLOAD_ERR_PARTIAL:
			$response = 'The uploaded file was only partially uploaded.';
			echo $response;
			exit;
			//break;
		case UPLOAD_ERR_NO_FILE:
			$response = 'No file was uploaded.';
			echo $response;
			exit;
			//break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
			echo $response;
			exit;
			//break;
		case UPLOAD_ERR_CANT_WRITE:
			$response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
			echo $response;
			exit;
			//break;
		default:
			$response = 'Unknown error';
			echo $response;
			exit;
		break;
	}

}

//scan "uploads" folder and display them accordingly
$folder = get_stylesheet_directory() .'/uploads';
$folderUri = get_stylesheet_directory_uri() .'/uploads';
$results = scandir($folder);
$ignored = array('.', '..', '.svn', '.htaccess');
$files = array();    
foreach ($results as $file) {
	if (in_array($file, $ignored)) continue;
	$files[$file] = filemtime($folder . '/' . $file);
}

arsort($files);
$files = array_keys($files);

foreach ($files as $result) {
	if ($result === '.' or $result === '..') continue;
      
	$extension = pathinfo($result, PATHINFO_EXTENSION);
	if ( ($extension == 'rtf') && is_file($folder . '/' . $result) ) 
	{
		$rtfFile = $folderUri . '/' .$result;
		$htmlFile = dirname($rtfFile) .'/'. basename($rtfFile,".$extension") . ".html";
		$uniFile = dirname($rtfFile) .'/'. basename($rtfFile,".$extension") . ".utf";
      		echo '<div>
			<p><a href="' .$rtfFile. '">' .$result. '</a></p>
			<p><a href="' .$htmlFile. '" class="button" role="button">See HTML</a></p>
			<p><form method="get" action="' .$uniFile. '"><button class="button" type="submit">Download Unicode Text</button></form></p>
    		</div>';
	}
}

?>
      
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
