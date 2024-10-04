<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Membuat table</title>
        <style>
        table{
        width: 70%;
        border-collapse: collapse;
        text-align: center;
        margin: auto;
            }
        th{
        font-style: oblique;
        color: blue;
        }
        tr{
            font-style: normal;
        }
</style>
    </head>
    <body>
        <?php
        $dosen = [
            'nama' => 'Elok Nur Hamdana',
            'domisili' => 'Malang',
            'jenis_kelamin' => 'Perempuan' ];
        
        echo '<table border="1">';
        echo '<tr><th>Nama</th><th>Domisili</th><th>Jenis Kelamin</th></tr>';
        echo "<tr><td>Elok Nur Hamdana</td><td>Malang</td><td>Perempuan</td></tr>";
?>
    </body>
</html>