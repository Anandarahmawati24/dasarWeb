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

$pattern= '/apple/';
$replacement = 'banana';
$text = 'I like apple pie.<br>';
$new_text = preg_replace($pattern, $replacement, $text);
echo $new_text; // output : "I like banana pie."

$pattern = '/go*d/'; // cocokkan "god", "good", "gooood",dll
$text = 'god is good.';
if (preg_match($pattern,$text, $matches)) {
    echo "Cocokan: ".$matches[0];
} else {
    echo "Tidak ada yang cocok!";
}
?>