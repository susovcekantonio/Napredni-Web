<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles</title>
    <style>
        .profile {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .profile img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .profile p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Profiles</h1>
    <?php
    $xmlString = file_get_contents('LV2.xml');
    $xmlString = str_replace('&', '&amp;', $xmlString);
    $xml = simplexml_load_string($xmlString);

    if ($xml === false) {
        die('Greška prilikom učitavanja XML datoteke.');
    }

    foreach ($xml->record as $record) {
        echo '<div class="profile">';
        echo '<img src="' . $record->slika . '" alt="Slika profila" width="50" height="50">';
        echo '<p><strong>Ime:</strong> ' . $record->ime . '</p>';
        echo '<p><strong>Prezime:</strong> ' . $record->prezime . '</p>';
        echo '<p><strong>Spol:</strong> ' . $record->spol . '</p>';
        echo '<p><strong>Email:</strong> ' . $record->email . '</p>';
        echo '<p><strong>Životopis:</strong> ' . $record->zivotopis . '</p>';
        echo '</div>';
    }
    ?>

</body>
</html>
