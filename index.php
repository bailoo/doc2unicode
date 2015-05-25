<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Convert RTF to Unicode</title>

    <!-- Bootstrap core CSS -->
    <link href="boostrap/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="ttf2uni.js"></script> 	
   
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
    	

	<div class="row">
	       <?php 
	       	//scan "uploads" folder and display them accordingly
	       $folder = "uploads";
	       $results = scandir('uploads');
	       foreach ($results as $result) {
	       	if ($result === '.' or $result === '..') continue;
	      
		$extension = pathinfo($result, PATHINFO_EXTENSION);
 
	       	if ( ($extension == 'rtf') && is_file($folder . '/' . $result) ) {
	       		echo '
	       		<div class="col-md-3">
		       		<div class="thumbnail">
				       		<p><a href="'.$folder . '/' .$result.'">' .$result. '</a>   	---- RTF Format OK </p>
				       		<div class="caption">
				       		<p><a href="txt2uni.php?rtf=' .$folder .'/' .$result.'" class="btn btn-primary btn-xs" role="button">Get Unicode</a></p>


			       		</div>
		       		</div>
	       		</div>';
	       	}
	       }
	       ?>
    	</div>
    	
    </div> <!-- /container -->

  </body>
</html>
