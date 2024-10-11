<?php 
$pattern ='/[a-z]/'; //cocokan huruf kecil
$text = 'This is a Sample Text.';
if(preg_match($pattern,$text)){
    echo "Huruf kecil ditemukan!<br>";
} else {
    echo "Tidak ada huruf kecil<br>";
}

$pattern='/[0-9]+/'; //cocokan satu atau lebih digit
$text ='There are 123 apples.';
if (preg_match($pattern, $text,$matches)) {
    echo "Cocokan: " .$matches[0] ."<br>";
} else {
    echo "Tidak ada cocok! <br>";
}
?>