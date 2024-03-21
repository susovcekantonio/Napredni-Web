<?php
include('DiplomskiRadovi.php');

// Instantiate DiplomskiRadovi class
$diplomskiRadovi = new DiplomskiRadovi();

// Read data from the database
$data = $diplomskiRadovi->read();

// Display data as HTML
foreach ($data as $work) {
    echo "<div>";
    echo "<h2>" . $work['naziv_rada'] . "</h2>";
    echo "<h3>" . $work['oib_tvrtke'] . "</h3>";
    echo "<p>" . $work['tekst_rada'] . "</p>";
    echo "<p>" . $work['link_rada'] . "</p>";
    echo "<br>";
    echo "</div>";
}
?>
