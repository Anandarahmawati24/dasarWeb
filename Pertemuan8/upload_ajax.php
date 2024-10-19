<?php 
if (isset($_FILES['file'])) {
    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type= $_FILES['file']['type'];
    $file_ext_array = explode('.', $file_name); // Pisahkan hasil explode ke variabel
    $file_ext = strtolower(end($file_ext_array)); // Panggil end() menggunakan variabel

    $extensions = array("png", "jpg", "jpeg", "gif");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Ekstensi file yang diizinkan adalah png, jpeg, jpg, atau gif.";
    }

    if ($file_size> 2097152) {
        $errors[] = 'ukuran file tidak boleh lebih dari 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "documents/" . $file_name);
        echo "File berhasil diunggah";
    } else {
        echo implode(" " , $errors);
    }
}
?>