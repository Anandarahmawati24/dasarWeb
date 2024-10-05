<!DOCTYPE html>
<html>
    <head>
        <title>Tugas database</title>
        <script src="jquery-3.7.1.js"></script>
        <script>
             $ (document) .ready(function() {
                $ ("#flip").click(function() {
                    $("#kotak") .slideToggle("slow");
                });
            });
        </script>
     <style>
            table {
                 width: 100%;
                 border-collapse: collapse;
                 margin: 10px 0;
                 font-size: 18px;
             }
             th{
                 padding: 10px;
                 border: 1px solid #000;
                 text-align: left;
             }
             td, ul{
                 padding: 10px;
                 border: 1px solid #000;
             }
             #kotak, #flip {
                 padding: 10px;
                 border: solid 3px white;
                 border-radius: 5px;
             }   
             #kotak{
                 text-align:left;
                 background-color: lavenderblush;
                 font-family: 'Courier New', Courier, monospace;
                 display: none;
             }
             #flip{
                 font-weight: bold;
                 text-align: center;
                 background-color: lavender;
                 font-size: 20px;

             }
             h2 {
                text-align: center;
                font-style: oblique;
                font-family: 'Times New Roman', Times, serif;
             }
         </style>
    </head>
    <body>
        <div id="flip">Click to show database</div>
        <div id="kotak">
            <h1>Data Siswa</h1>
            <table>
                    <tr>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                    </tr>
                    <?php
                    $siswa = [
                        ["nama" => "Andi", "umur" => 15, "kelas" => "10A", "alamat" => "Malang"],
                        ["nama" => "Siti", "umur" => 16, "kelas" => "10B", "alamat" => "Batu"],
                        ["nama" => "Budi", "umur" => 15, "kelas" => "10A", "alamat" => "Dinoyo"],
                        ["nama" => "Anton", "umur" => 25, "kelas" => "15A", "alamat" => "Dinoyo"]
                    ];
                    
                    $totalUmur = 0;
                    foreach ($siswa as $data) {
                        echo "<tr>";
                        echo "<td>{$data['nama']}</td>";
                        echo "<td>{$data['umur']}</td>";
                        echo "<td>{$data['kelas']}</td>";
                        echo "<td>{$data['alamat']}</td>";
                        echo "</tr>";

                        $totalUmur += $data['umur'];
                    }
                    $jumlahSiswa = count($siswa);
                    $rataRataUmur = $totalUmur / $jumlahSiswa;
                    ?>
            </table>
            <h2>Rata-rata umur siswa: <?php echo $rataRataUmur; ?> tahun</h2>
        </div>
    </body>
</html>