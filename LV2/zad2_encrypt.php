<?php

// Funkcija za generiranje nasumičnog imena datoteke
function generateRandomName($length = 5) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

// Provjera da li je datoteka poslana putem POST metode
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Podaci o datoteci
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];


    // Generiranje nasumičnog imena za datoteku
    $randomName = generateRandomName();
    $encryptedFileName = $randomName . '.enc';

    // Kriptiranje datoteke
    $encryption_key = md5('jed4n j4k0 v3l1k1 kljuc');
    $cipher = 'AES-128-CTR';
    $iv_length = openssl_cipher_iv_length($cipher);
    $encryption_iv = random_bytes($iv_length); // Generiranje inicijalizacijskog vektora
    $_SESSION['iv'] = $encryption_iv;

    $encryptedContent = openssl_encrypt(file_get_contents($fileTmpName), $cipher, $encryption_key, 0, $encryption_iv); // Kriptiranje sadržaja

    // Pohrana kriptirane datoteke
    file_put_contents($encryptedFileName, $encryption_iv . $encryptedContent);

    echo 'Datoteka je uspješno uploadana i kriptirana.';

    //Link prema decrypt php-u
    echo '<br><br><a href="zad_2_decrypt.php">Dekriptiraj datoteke</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload i kriptiranje dokumenta</title>
</head>
<body>
    <h2>Upload i kriptiranje dokumenta</h2>
    <form action="" method="post" enctype="multipart/form-data">
        Odaberite datoteku za upload: <input type="file" name="file" accept="image/jpeg, image/png, application/pdf"><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
