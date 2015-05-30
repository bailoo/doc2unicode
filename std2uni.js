
var array_one = new Array("X","Y","ûÊZ","BË","Ë","Ì","Í","Î",
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
"ँा","ँू","ेा","ंे","ाें","ॅं","ंॅ"," ः","ंू")     // Remove typing mistakes in the original file

var array_two = new Array("","","ûÊ","ईं","aÊ","aÍ","dÊ","aÊ",
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
"ाँ","ूँ","ो","ें","ों","ँ","ँ"," :","ूं")     // Remove typing mistakes in the original file 

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

var array_one_length = array_one.length;

fs=require('fs');
var modified_substring = fs.readFileSync('/dev/stdin').toString();
Replace_Symbols( );
console.log(modified_substring);

// --------------------------------------------------


function Replace_Symbols( )
{

//substitute array_two elements in place of corresponding array_one elements

if ( modified_substring != "" )  // if stringto be converted is non-blank then no need of any processing.
{
for ( input_symbol_idx = 0;   input_symbol_idx < array_one_length;    input_symbol_idx++ )

{ 

//  alert(" modified substring = "+modified_substring)

//***********************************************************
// if (input_symbol_idx==106) 
//  { alert(" input_symbol_idx = "+input_symbol_idx);
//    alert(" input_symbol_idx = "+input_symbol_idx)
//; alert(" character =" + modified_substring.CharCodeAt(input_symbol_idx))
//     alert(" character = "+modified_string.fromCharCode(input_symbol_idx)) 
//   }
// if (input_symbol_idx == 107) 
//   { alert(" input_symbol_idx = "+input_symbol_idx);
//    alert(" character = ",+string.fromCharCode(input_symbol_idx)) 
//   }
//***********************************************************
idx = 0  ;  // index of the symbol being searched for replacement

while (idx != -1 ) //while-00
{

modified_substring = modified_substring.replace( array_one[ input_symbol_idx ] , array_two[input_symbol_idx] )
idx = modified_substring.indexOf( array_one[input_symbol_idx] )

} // end of while-00 loop
// alert(" end of while loop")
} // end of for loop
// alert(" end of for loop")

// alert(" modified substring2 = "+modified_substring)
//*******************************************************
var position_of_i = modified_substring.indexOf( "d" )

while ( position_of_i != -1 )  //while-02
{
var charecter_next_to_i = modified_substring.charAt( position_of_i + 1 )
var charecter_to_be_replaced = "d" + charecter_next_to_i
modified_substring = modified_substring.replace( charecter_to_be_replaced , charecter_next_to_i + "ि" ) 
position_of_i = modified_substring.search( /d/ , position_of_i + 1 ) // search for i ahead of the current position.

} // end of while-02 loop

//**********************************************************************************
// End of Code for Replacing four Special glyphs
//**********************************************************************************

// following loop to eliminate 'chhotee ee kee maatraa' on half-letters as a result of above transformation.

var position_of_wrong_ee = modified_substring.indexOf( "ि्" ) 

while ( position_of_wrong_ee != -1 )  //while-03

{
var consonent_next_to_wrong_ee = modified_substring.charAt( position_of_wrong_ee + 2 )
var charecter_to_be_replaced = "ि्" + consonent_next_to_wrong_ee 
modified_substring = modified_substring.replace( charecter_to_be_replaced , "्" + consonent_next_to_wrong_ee + "ि" ) 
position_of_wrong_ee = modified_substring.search( /ि्/ , position_of_wrong_ee + 2 ) // search for 'wrong ee' ahead of the current position. 

} // end of while-03 loop

// following loop to eliminate 'chhotee ee kee maatraa' on half-letters as a result of above transformation.

var position_of_wrong_ee = modified_substring.indexOf( "िं्" ) 

while ( position_of_wrong_ee != -1 )  //while-03

{
var consonent_next_to_wrong_ee = modified_substring.charAt( position_of_wrong_ee + 3 )
var charecter_to_be_replaced = "िं्" + consonent_next_to_wrong_ee 
modified_substring = modified_substring.replace( charecter_to_be_replaced , "्" + consonent_next_to_wrong_ee + "िं" ) 
position_of_wrong_ee = modified_substring.search( /िं्/ , position_of_wrong_ee + 3 ) // search for 'wrong ee' ahead of the current position. 

} // end of while-03 loop


// Eliminating reph "Ô" and putting 'half - r' at proper position for this.
set_of_matras = "ा ि ी ु ू ृ े ै ो ौ ं : ँ ॅ" 
var position_of_R = modified_substring.indexOf( "Ê" )

while ( position_of_R > 0 )  // while-04
{
probable_position_of_half_r = position_of_R - 1 ;
var charecter_at_probable_position_of_half_r = modified_substring.charAt( probable_position_of_half_r )


// trying to find non-maatra position left to current O (ie, half -r).

while ( set_of_matras.match( charecter_at_probable_position_of_half_r ) != null )  // while-05

{
probable_position_of_half_r = probable_position_of_half_r - 1 ;
charecter_at_probable_position_of_half_r = modified_substring.charAt( probable_position_of_half_r ) ;

} // end of while-05


charecter_to_be_replaced = modified_substring.substr ( probable_position_of_half_r , ( position_of_R - probable_position_of_half_r ) ) ;
new_replacement_string = "र्" + charecter_to_be_replaced ; 
charecter_to_be_replaced = charecter_to_be_replaced + "Ê" ;
modified_substring = modified_substring.replace( charecter_to_be_replaced , new_replacement_string ) ;
position_of_R = modified_substring.indexOf( "Ê" ) ;

} // end of while-04

//**********punctuation marks ****************
//    "¡","£","¤","¥","²","³","´","µ","¹","À","Á","Â","Ã","Ä","Å","Æ","Ç","È","Ê","Ñ","Ò","Õ",
// "{","}","[","]","!","(",")","*","-","/",":",";","<","=",">","?","@","|",",","!","\\","√","-",
//***************************************************
// Remove space between a charcter and maatraa
//*************************************************** 
modified_substring = modified_substring.replace( / ा/g , "ा" )   ;  
modified_substring = modified_substring.replace( / ॉ/g , "ॉ" )   ;  
modified_substring = modified_substring.replace( / ि/g , "ि" )   ;  
modified_substring = modified_substring.replace( / ी/g , "ी" )   ;  
modified_substring = modified_substring.replace( / ु/g , "ु" )   ;  
modified_substring = modified_substring.replace( / ू/g , "ू" )   ;  
modified_substring = modified_substring.replace( / े/g , "े" )   ;  
modified_substring = modified_substring.replace( / ै/g , "ै" )   ;  
modified_substring = modified_substring.replace( / ो/g , "ो" )   ;  
modified_substring = modified_substring.replace( / ौ/g , "ौ" )   ;  

} // end of IF  statement  meant to  supress processing of  blank  string.

} // end of the function  Replace_Symbols




