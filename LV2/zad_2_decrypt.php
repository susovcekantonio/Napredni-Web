<?php
session_start();

// Funkcija za dekriptiranje sadržaja datoteke
function decryptFile($filePath, $key, $iv) {
    // Čitanje sadržaja datoteke
    $encryptedContent = file_get_contents($filePath);
    
    // Izdvajanje inicijalizacijskog vektora i kriptiranog sadržaja
    $ivSize = openssl_cipher_iv_length('aes-128-ctr');
    $iv = substr($encryptedContent, 0, $ivSize);
    $encryptedContent = substr($encryptedContent, $ivSize);
    
    // Dekriptiranje sadržaja
    $decryptedContent = openssl_decrypt($encryptedContent, 'aes-128-ctr', $key, 0, $iv);
    
    return $decryptedContent;
}

// Dohvaćanje svih kriptiranih datoteka
$encryptedFiles = glob('*.enc');

// Ključ za dekriptiranje
$key = md5('jed4n j4k0 v3l1k1 kljuc'); 

// Prikaz linkova za preuzimanje dekriptiranih dokumenata
foreach ($encryptedFiles as $file) {
    // Dekriptiranje sadržaja datoteke
    $decryptedContent = decryptFile($file, $key, $_SESSION['iv']);
    
    // Generiranje linka za preuzimanje dekriptiranog dokumenta
    $decryptedFileName = basename($file, '.enc'). '_decrypted.jpg';;
    $decryptedFilePath = $decryptedFileName;
    
    // Pohrana dekriptiranog sadržaja u novu datoteku
    file_put_contents($decryptedFilePath, $decryptedContent);
    
    // Prikaz linka za preuzimanje
    echo '<a href="' . $decryptedFilePath . '">Preuzmi ' . $decryptedFileName . '</a><br>';
}
?>
