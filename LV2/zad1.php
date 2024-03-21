<?php
// Postavke baze podataka
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'napredni-lv1'; 

// Spajanje na bazu podataka
$conn = new mysqli($host, $username, $password, $database);

// Provjera konekcije
if ($conn->connect_error) {
    die("Neuspješno spajanje na bazu podataka: " . $conn->connect_error);
}

// Naziv datoteke za backup
$backupFile = 'diplomski_radovi_' . date('Y-m-d') . '.txt';

// Otvaranje datoteke za pisanje
$fp = fopen($backupFile, 'w');

// Dohvaćanje popisa tablica
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Backup svake tablice
foreach ($tables as $table) {
    $result = $conn->query("SELECT * FROM $table");
    $numColumns = $result->field_count;

    // Kreiranje upita za svaki redak u tablici
    while ($row = $result->fetch_assoc()) {
        $columns = array();
        $values = array();

        foreach ($row as $key => $value) {
            $columns[] = $key;
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }

        $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") \n VALUES (" . implode(', ', $values) . ");\n";

        fwrite($fp, $sql);
    }
}

// Zatvaranje datoteke
fclose($fp);

echo "Backup uspješno napravljen";

// Zatvaranje konekcije na bazu podataka
$conn->close();
?>
