<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form action="./logout.php"><input type="submit" value="apagar dados"></form>

<?php

if(!isset($_SESSION)){
    session_start();
}


echo '<pre>';
print_r($_SESSION);
echo '</pre>';

?>
    
</body>
</html>