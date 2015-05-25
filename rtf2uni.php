<?php
	require_once 'rtfclass.php';

	$rtfName = "sample.rtf";
	Ted2Uni($rtfName);

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
