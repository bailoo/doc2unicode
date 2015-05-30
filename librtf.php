<?php

require __DIR__ . '/vendor/autoload.php';
use PHPHtmlParser\Dom;

//require_once "rtfclass.php";

/* convert rtf to unicode text */
/* 	*/
/* 	*/
/* 	*/
/* 	*/
/* 	*/

/*function rtfToUnicode($rtfName)
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
*/

/* convert rtf to txt using Ted */
/* convert txt to Unicode adapted from JS code */
/* return 0 on success */
/* return error code on fail */

function rtfToUnicode($rtfName)
{
	$rtfDir = dirname($rtfName);
	$txtName = $rtfDir .'/'. basename($rtfName,".rtf") . "_foo.html";
	$uniName = $rtfDir .'/'. basename($rtfName,".rtf") . ".utf";
	//echo "rtfName = $rtfName\n";
	//echo "txtName = $txtName\n";
	//echo "uniName = $uniName\n";
	exec("/usr/bin/Ted --saveTo " .$rtfName. " " .$txtName, $retarr, $retval);
	if ($retval != 0) {
		exec("/bin/mv -f " .$rtfName. " " .$rtfDir. "/errors"); 
		return 1;
	}
	//exec("/bin/sed -i 's/X//g;s/Y//g' " .$txtName, $retarr, $retval);
	//if ($retval != 0) return $retval;
	exec("/bin/sed -i 's/×Y/./g;s/ÎÀF/dÀFa/g' " .$txtName, $retarr, $retval);
	if ($retval != 0) return 2;

	$uniCodeArr = htmlToUni($txtName);

	$htmlName = dirname($rtfName) .'/'. basename($rtfName,".rtf") . ".html";
	file_put_contents($htmlName, "
<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>Convert RTF to Unicode</title>
	<style>
    		@import url(http://fonts.googleapis.com/earlyaccess/notosansdevanagari.css);
		body { font-family: 'Noto Sans Devanagari', sans-serif };
	</style>
	<body>
	");

	foreach($uniCodeArr as $uniCode)
	{
		file_put_contents($htmlName, "<div>" .$uniCode. "</div>", FILE_APPEND | LOCK_EX);
	}
	file_put_contents($htmlName, "</body></html>", FILE_APPEND | LOCK_EX);

    	/*
	$legacyCode = file_get_contents($txtName);
    	$uniCode = replaceSymbols($legacyCode);
	$uniName = dirname($txtName) .'/'. basename($txtName,".txt") . "_unicode.txt";
    	file_put_contents($uniName, $uniCode);
	*/

	return 0;

}


/* parse html of Ted output, convert font to Unicode */ 
/* returns Unicode array */

function htmlToUni($htmlName)
{
	
	$jsFile = "/home/kadmin/work/ht/wordpress/wp-content/themes/doc2unicode/txt2uni.js";
	$tmpFile = "/home/kadmin/work/ht/wordpress/wp-content/themes/doc2unicode/uploads/tmp";

	$dom = new Dom;
	$dom->loadFromFile($htmlName);
	$contents = $dom->find('span');
	//echo "count = " .count($contents); echo "\n";

	$i = 0;	
	foreach ($contents as $content)
	{
		//$class = $content->getAttribute('class');
		//echo "class = " .$class; echo "\n";
		$html = $content->innerHtml;
		file_put_contents($tmpFile,$html);
		exec("/usr/bin/node " .$jsFile. " " .$tmpFile, $retarr, $retval);
		if ($retval != 0) return 3;
	}
	return $retarr;
}


/* substitute array_two elements in place of corresponding array_one elements */

function replaceSymbols($legacyCode)
{

	$array_one = array("X","Y","ûÊZ","BË","Ë","Ì","Í","Î",
"¬","IÞY","JÞ","¦FÞ","¬F","OÞ","PÞ","RÞ",
"÷","ø",
"Ù","Ú","Û","Ü","Ý",

"Ã","Ä",

"n","o","}","~", "‘","’","“","”", "˜","™","š","›","©", "«",
"‚","ƒ","„","…","†","‡","ˆ","‰","Š","‹","Œ","Å",
"á","â","ã","ä","å","æ","ç","è","é","ê","ë","ì","í","î","ï",
"ð","ñ","ò","ó","ô","õ","ö","ÿ","Ö", "Ø", 

"j","É",

"œ","Â","{","p","–", "¤","¥","Ï","ß",
"•","·","ù","ú",            

"¢","£", "¦","§", "I","J","K",    
"¨","ª", "Ó", "®", "L","þ",
"M","N","O","P","¯",
"°","±","²","³","Q","ý",
"´","µ","¶","•","¸", "R",

"¹","»","¼","½","¾","V","¿","À","Á",          
"S","T","U","W","à","Õ",

"i","Ñ",
"A","BÊ","B","C","D","f","g","E","H",

"F","e","b",  "Æ","c","Ç","È", "Z", "`","m","|","û","ü",   
"h", "a","G","Ð","Ò","Ô", "×","Þ",

"q","r","s","t","u","v","w","x","y","z",

"k","l","—","­",

"्ा","्ो","्ौ","अो","अा","आै","आे","ाो","ाॅ","ॅा","ाे","अौ","एे","आॅ",
"ंु","ेे","अै","ाे","अे","ंा","अॅ","ाै","ैा","ंृ",
"ँा","ँू","ेा","ंे","ाें","ॅं","ंॅ"," ः","ंू");// Remove typing mistakes in the original file

	$array_two = array("","","ûÊ","ईं","aÊ","aÍ","dÊ","aÊ",
"ज़्","क़","ख़","ग़","ज़","ड़","ढ़","फ़",   // one-byte-varnas
"रु","रू",
"॰","ऽ","ॐ","।","॥",

"क्ष्","ज्ञ्",

"ल्ल","ङ्म", "त्न","प्त", "ह्य","ह्ण","ह्ल","ह्व","ट्ट","ट्ठ","ह्म्","श्च","च्च्", "ज्ज्",
"ङ्क","ङ्ख","ङ्ग","ङ्घ","ङ्क्त","ञ्च","क्च","ह्न","द्ब्र","ढ्ढ","छ्व","ष्ट्व",
"ष्ट","ष्ठ","श्ल","श्व","स्त्र","क्क","ड्ड","ड्ढ","क्व","स्न","्य","ञ्ज","द्ग","द्घ","द्द",
"द्ध","द्ब","द्भ","द्म","द्य","द्व","क्त","ठ्ठ","न्न्", "त्त्",

"्न", "्ल",

"क्र","त्र्","त्र","स्र","झ्र","ख्र्","ख्न्","ह्र","श्र्",
"भ्","भ्","हृ","दृ", //"डृ",      

"क्","ख्","ग्","घ्","क","ख","ङ",  
"च्", "ज्", "झ्", "ञ्","छ","ज",
"ट","ठ","ड", "ढ","ण्",
"त्","थ्","ध्","न्","द","द",
"प्","फ्","ब्","भ्","म्","फ",

"य्","ल्","ळ्","व्","श्","श्","ष्","स्","ह्",    
"र","ळ","व","ह","श","ल",

"्र","्र",

"अ","ई","इ","उ","ऊ","ऋ","ॠ","ए","ऌ",

"ा","ी","ु","ु","ू","ू","ृ", "े","ै","े","े", "ो","ौ", 
"ँ","ं","ॅ","्","ँ","ं","़","़",

"०","१","२","३","४","५","६","७","८","९",

"‘","’","-","-",

"","े","ै","ओ","आ","औ","ओ","ो","ॉ","ॉ","ो","औ","ऐ","ऑ",
"ुं","े","अ‍ै","ो","अ‍े","ां","अ‍ॅ","ौ","ौ","ृं",
"ाँ","ूँ","ो","ें","ों","ँ","ँ"," :","ूं"); // Remove typing mistakes in the original file 

//**************************************************************************************
//
// Punctuation marks incorporated at the end
//
//**************************************************************************************
// The following two characters are to be replaced through proper checking of locations:
//**************************************************************************************
//   "d",
//   "ि",
//
//  "Ê",
// "र्" (reph), 
//**************************************************************************************

	$array_one_length = sizeof($array_one);

	if ( $legacyCode != "" )  // if stringto be converted is blank then no need of any processing
	{
		for ( $idx = 0; $idx < $array_one_length; $idx++ )
		{
			echo "idx = $idx \n";
			echo "modified string = $legacyCode \n";
			$legacyCode = str_replace($array_one[$idx] , $array_two[$idx], $legacyCode);
		}
		//echo "modified string = $legacyCode \n";

		$legacyCode = preg_replace('/d(\w)/', '${1}ि', $legacyCode);
		//echo "modified string = $legacyCode \n";
		//End of Code for Replacing four Special glyphs

		//Eliminate 'chhotee ee kee maatraa' on half-letters as a result of above transformation
		$legacyCode = preg_replace('/ि्(\w)/', '"्${1}ि', $legacyCode);
		$legacyCode = preg_replace('/िं्(\w)/', '"्${1}िं', $legacyCode);
		//echo "modified string = $legacyCode \n";

		//Eliminate reph "Ô" and putting 'half - r' at proper position for this
		$set_of_matras = "ा ि ी ु ू ृ े ै ो ौ ं : ँ ॅ";
		$position_of_R = strpos($legacyCode, "Ê" );
		
		while ( $position_of_R > 0 )  // while-04
		{
			$probable_position_of_half_r = $position_of_R - 1;
			$char_at_probable_position_of_half_r = $legacyCode[ $probable_position_of_half_r ];
		
			// trying to find non-maatra position left to current O (ie, half -r)
			while ( preg_match($char_at_probable_position_of_half_r, $set_of_matras ) != null )  // while-05
			{	
				$probable_position_of_half_r = $probable_position_of_half_r - 1;
				$char_at_probable_position_of_half_r = $legacyCode[ $probable_position_of_half_r ];
			} // end of while-05
		
			$char_to_be_replaced = substr($legacyCode, $probable_position_of_half_r , $position_of_R - $probable_position_of_half_r );
			$new_replacement_string = "र्" . $char_to_be_replaced; 
			$char_to_be_replaced = $char_to_be_replaced . "Ê";
			$legacyCode = str_replace($char_to_be_replaced , $new_replacement_string, $legacyCode );
			$position_of_R = strpos($legacyCode, "Ê" );
		
		} // end of while-04
		
		//**********punctuation marks ****************
		//    "¡","£","¤","¥","²","³","´","µ","¹","À","Á","Â","Ã","Ä","Å","Æ","Ç","È","Ê","Ñ","Ò","Õ",
		// "{","}","[","]","!","(",")","*","-","/",":",";","<","=",">","?","@","|",",","!","\\","√","-",
		//***************************************************
		// Remove space between a charcter and maatraa
		//*************************************************** 
		$legacyCode = str_replace(" ा" , "ा" , $legacyCode);  
		$legacyCode = str_replace(" ॉ" , "ॉ" , $legacyCode);  
		$legacyCode = str_replace(" ि" , "ि" , $legacyCode);  
		$legacyCode = str_replace(" ी" , "ी" , $legacyCode);  
		$legacyCode = str_replace(" ु" , "ु" , $legacyCode);  
		$legacyCode = str_replace(" ू" , "ू" , $legacyCode);  
		$legacyCode = str_replace(" े" , "े" , $legacyCode);  
		$legacyCode = str_replace(" ै" , "ै" , $legacyCode);  
		$legacyCode = str_replace(" ो" , "ो" , $legacyCode);  
		$legacyCode = str_replace(" ौ" , "ौ" , $legacyCode);  
		
	}

	return $legacyCode;

}

?>
