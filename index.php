<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Convert RTF to Unicode</title>

    <!-- Bootstrap core CSS -->
    <link href="boostrap/css/bootstrap.min.css" rel="stylesheet">
    
  </head>

  <body>

    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Convert RTF to Unicode</a>
        </div>
      </div>
    </div>


    <div class="container">
    
	      <div class="row">
	      	<div class="col-lg-12">
	           <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
				  <div class="form-group">
				    <label for="file">Select an RTF file to upload</label>
				    <input type="file" name="file">
				  </div>
				  <input type="submit" class="btn btn-lg btn-primary" value="Upload">
				</form>
			</div>
	      </div>
    	

	       		<?php 
	       			//scan "uploads" folder and display them accordingly
	       			$folder = "uploads";
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
	       				if ( ($extension == 'rtf') && is_file($folder . '/' . $result) ) {
						$rtfFile = $folder . '/' .$result;
						$htmlFile = dirname($rtfFile) .'/'. basename($rtfFile,".$extension") . ".html";
						$uniFile = dirname($rtfFile) .'/'. basename($rtfFile,".$extension") . ".txt";
	       					echo '
	      					<div class="thumbnail">
						<p><a href="' .$rtfFile. '">' .$result. '</a></p>
						<p><a href="' .$htmlFile. '" class="btn btn-primary btn-xs" role="button">See HTML</a></p>
						<p><form method="get" action="' .$uniFile. '"><button class="btn btn-primary btn-xs" type="submit">Download Unicode Text</button></form></p>
    						</div>';
	       				}
	       			}
	       		?>
	      
    </div> <!-- /container -->

  </body>
</html>
