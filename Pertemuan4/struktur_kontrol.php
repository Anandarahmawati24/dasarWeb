<?php
$nilaiNumerik = 92;
if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) { echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) { echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) { echo "Nilai huruf: D";
}

$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}
echo"<br>";
echo "Atlet tersebut memelukan $hari hari untuk mencapai jarak 500 kilometer.";

$jumlahLahan = 10;
$tanamanPerlahan = 5;
$buahPerTanaman =10;
$jumlahBuah =0;

for ($i =1; $i <= $jumlahLahan; $i++) {
    $jumlahBuah += ($tanamanPerlahan * $buahPerTanaman);
}
echo"<br>";
echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah";

$skorUjian = [85, 92, 78, 96, 88];
$totalSkor =0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}
echo"<br>";
echo "Total skor ujian adalah: $totalSkor";

$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai <60) {
        echo "Nilai: $nilai (Tidak lulus) <br>";
        continue;
    }
    echo "<br>";
    echo "Nilai: $nilai (lulus) <br>";
}

$nilai=[85,92,78,64,90,75,88,79,70,96];

$n = count($nilai);
for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($nilai[$j] > $nilai[$j + 1]) {
            // Menukar posisi jika nilai saat ini lebih besar dari nilai berikutnya
            $temp = $nilai[$j];
            $nilai[$j] = $nilai[$j + 1];
            $nilai[$j + 1] = $temp;
        }
    }
}

$total_nilai = 0;
for ($i = 2; $i <= 7; $i++) {
    $total_nilai += $nilai[$i];
}
$rata_rata = $total_nilai / 6;
echo"<br>";
echo "Total Nilai: $total_nilai<br>";
echo "Rata-Rata: $rata_rata<br><br>";

$harga_awal = 120000;

if ($harga_awal > 100000) {
    $diskon = 20 / 100; 
    $potongan = $harga_awal * $diskon; 
    $harga_setelah_diskon = $harga_awal - $potongan; 
} else {
    $harga_setelah_diskon = $harga_awal; 
}

echo "Harga awal: Rp $harga_awal<br>";
echo "Potongan harga: Rp $potongan<br>";
echo "Harga setelah diskon: Rp $harga_setelah_diskon<br>";
?>