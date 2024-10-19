<?php 
//lokasi penyimpanan file yang diunggah
$targetDirectory = "documents/";

//periksa apakah direktori penyimpanan ada, jika tidak maka buat
if(!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

if ($_FILES['files']['name'][0]) {
    $totalFiles = count($_FILES['files']['name']);

    //loop memlalui semua file yang diunggah
    for ($i=0; $i < $totalFiles; $i++){
        $fileName = $_FILES['files']['name'][$i];
        $targetFile = $targetDirectory . $fileName;

        //pindahkan file yang diunggah ke direktori penyimpanan
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
            echo "File $fileName berhasil diunggah.<br>";
        } else {
            echo "Gagal mengunggah file $fileName.<br>";
        }
    } 
} else {
    echo "tidak ada file yang diunggah.";
}
?>