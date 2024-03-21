<?php
    include('DiplomskiRadovi.php');

    $diplomskiRadovi = new DiplomskiRadovi();
    if(isset($_POST['submitButton'])){
        $diplomskiRadovi->create($_POST['pageN']);
        $diplomskiRadovi->save();
    }
    header('Location: http://localhost/napredno-lv1/index.php');
    die();
?>