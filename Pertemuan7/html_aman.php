<!DOCTYPE html>
<html>
<head>
    <title>Input Aman htmlspecialchars</title>
</head>
<body>
    <h2>Form Input PHP Aman</h2>
    <form method="post" action="html_aman.php">
        <label for="input">Masukkan sesuatu:</label>
        <input type="text" name="input" id="input" required><br><br>

        <label for="email">Masukkan email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mengamankan input teks
        $input = $_POST['input'];
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        echo "Input yang diterima: " . $input . "<br>";

        // Memeriksa dan mengamankan input email
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            echo "Email yang diterima: " . $email;
        } else {
            echo "Input email tidak valid.";
        }
    }
    ?>
</body>
</html>