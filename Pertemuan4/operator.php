<?php
$a =10;
$b=5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a /$b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Hasil operator <br>";
echo "Hasil Tambah: {$hasilTambah} <br>";
echo "Hasil Kurang: {$hasilKurang} <br>";
echo "Hasil Kali: {$hasilKali} <br>";
echo "Hasil Bagi: {$hasilBagi} <br>";
echo "Hasil Sisa Bagi: {$sisaBagi} <br>";
echo "Hasil Pangkat: {$pangkat} <br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;
echo "<br><br>";
echo "Hasil Sama: {$hasilSama} <br>";
echo "Hasil Tidak Sama: {$hasilTidakSama} <br>";
echo "Hasil Lebih Kecil: {$hasilLebihKecil} <br>";
echo "Hasil Lebih Besar: {$hasilLebihBesar} <br>";
echo "Hasil Lebih Kecil Sama: {$hasilLebihKecilSama} <br>";
echo "Hasil Lebih Besar Sama: {$hasilLebihBesarSama} <br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;
echo"<br><br>";
echo"Hasil And: {$hasilAnd} <br>";
echo"Hasil Or: {$hasilOr} <br>";
echo"Hasil Not A: {$hasilNotA} <br>";
echo"Hasil Not B: {$hasilNotB} <br>";

$hasilPenugasanPenjumlahan= $a += $b;
$hasilPenugasanPengurangan =$a -=$b;
$hasilpenugasanPerkalian= $a *= $b;
$hasilPenugasanPembagian=$a /= $b;
$hasilPenugasanSisaBagi=$a %= $b;

echo"<br><br>";
echo "Hasil dari Penugasan Penjumlahan (+=) : {$hasilPenugasanPenjumlahan} <br>";
echo "Hasil dari Penugasan Pengurangan (-=) : {$hasilPenugasanPengurangan} <br>";
echo "Hasil dari Penugasan Perkalian (*=) : {$hasilpenugasanPerkalian} <br>";
echo "Hasil dari Penugasan Pembagian (/=) : {$hasilPenugasanPembagian} <br>";
echo "Hasil dari Penugasan Sisa Bagi (%=) : {$hasilPenugasanSisaBagi} <br>";
?>