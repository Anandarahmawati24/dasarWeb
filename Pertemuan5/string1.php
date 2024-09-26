<?php

$loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Voluptatem reprehenderit nobis veristatis commodi fugiat molestias
    impedit unde ipsum voluptatum, corrupti minus sit excepturi nostrum
    quisquam? Quos impedit eum nulla optio.";

echo "<p>{$loremIpsum}</p>";
echo "Panjang karakter: " . strlen($loremIpsum) . "<br>";
echo "Panjang kata: " . str_word_count($loremIpsum) . "<br>";
echo "<p>" . strtoupper($loremIpsum) . "</p>";
echo "<p>" . strtolower($loremIpsum) . "</p>";

?>