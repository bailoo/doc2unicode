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
	       		<div class="col-md-3">
		       		<div class="thumbnail">
				       <p><a href="<?php echo $_GET['rtf'] ?>"><?php echo basename($_GET['rtf']) ?></a></p>

<textarea name="TextToConvert" id="legacy_text" cols="82" rows="6"> <?php echo file_get_contents(dirname($_GET['rtf']) .'/'. basename($_GET['rtf'],".rtf").'.txt')?> </textarea> <br>

<div align="middle">
<input  type="button" class="btn btn-primary btn-xs" name="converter" id="converter" value="Get Unicode" onClick="convert_to_unicode();" accesskey="c" title="shortc"> 
</div>  <br>

<b>Unicode Output</b> <br/>
<textarea name="ConvertedText" id="unicode_text" cols="82" rows="6"></textarea>
<br />

			       		</div>
		       		</div>
	      </div>
    </div> <!-- /container -->

  </body>
</html>



