<?php

	require __DIR__ . '/vendor/autoload.php';
	use PHPHtmlParser\Dom;

	$jsFile = "/home/kadmin/work/ht/wordpress/wp-content/themes/doc2unicode/txt2uni.js";
	$tmpFile = "/home/kadmin/work/ht/wordpress/wp-content/themes/doc2unicode/tmp";

	$dom = new Dom;
	$dom->loadFromFile($argv[1]);
	$contents = $dom->find('span');
	echo "count = " .count($contents); echo "\n";

	$i = 0;	
	foreach ($contents as $content)
	{
		$class = $content->getAttribute('class');
		echo "class = " .$class; echo "\n";
		$html = $content->innerHtml;
		echo "html = " .$html; echo "\n";
		//file_put_contents($tmpFile,$html);
		//exec("/usr/bin/node " .$jsFile. " " .$tmpFile, $retarr, $retval);
		//echo($retarr[$i++]);
	}

?>
		
		
