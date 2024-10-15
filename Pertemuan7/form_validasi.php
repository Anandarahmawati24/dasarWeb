<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi</h1>
    <form id="myForm" action="proses_validasi.php" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span>
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span>
        <br>

        <input type="submit" value="Submit">
    </form>

    <div id="form-result"></div> 

    <script>
        $(document).ready(function() {
            $("#myForm").submit(function(event) {
                event.preventDefault();
                var nama = $("#nama").val();
                var email = $("#email").val();
                var valid = true;

                // Validasi Nama
                if (nama === "") {
                    $("#nama-error").text("Nama harus diisi.");
                    valid = false;
                } else {
                    $("#nama-error").text("");
                }

                // Validasi Email
                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                } else {
                    $("#email-error").text("");
                }

                // Menghentikan pengiriman form jika validasi gagal
                // if (!valid) {
                //     return false; // Menghentikan pengiriman jika tidak valid
                // }

                if (valid) {
                    // Kirim form dengan AJAX
                    $.ajax({
                        url: "proses_validasi.php", 
                        type: "POST",               
                        data: { nama: nama, email: email }, 
                        success: function(response) {
                            $("#form-result").html(response); 
                        },
                        error: function() {
                            $("#form-result").html("Terjadi kesalahan saat mengirim data."); 
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>