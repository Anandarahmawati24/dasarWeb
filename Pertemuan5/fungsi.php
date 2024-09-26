<?php
function perkenalan1(){
    echo "Assalamualaikum, ";
    echo "Perkenalkan, nama saya Nanda<br/>";
    echo "Senang berkenalan dengan anda</br>";
}

//memanggil fungsi yang sudah dibuat
perkenalan1();

//membuat fungsi
function perkenalan($nama, $salam="Assalamualaikum"){
    echo $salam.", ";
    echo "Perkenalkan, nama saya ".$nama."<br/>";
    echo "Senang berkenalan dengan anda<br/>";

}

//memanggil fungsi yang sudah dibuat
perkenalan("Hamdana", "Halo");

echo "<hr>";

$saya = "Elok";
$ucapanSalam = "Selamat pagi";

//memanggil lagi tanpa mengisi parameter salam
perkenalan($saya);

function hitungUmur($thn_lahir, $thn_sekarang){
    $umur = $thn_sekarang - $thn_lahir;
    return $umur;
}

echo "Umur saya adalah ". hitungUmur(2005, 2024) ." tahun";
?>