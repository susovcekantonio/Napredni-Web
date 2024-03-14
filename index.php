<?php include('DiplomskiRadovi.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NWP LV1</title>
</head>
<body>
    <form method="post" action="submit.php">
        <label for="pageN">Choose page:</label>
        <input type="number" id="pageN" name="pageN" value="2"><br>
        <input type="submit" name="submitButton" value="Submit"/><br> 
    </form> 
    
    <form method="post" action="read.php">
        <input type="submit" name="readButton" value="Read Data"/><br> 
    </form> 
</body>
</html>