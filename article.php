<?php
session_start();
require "functions.php";
$id = $_GET['id'];
$artikel = querysql("SELECT * FROM artikel WHERE id = $id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <title>Article</title>
</head>

<body>
    <h1><?= $artikel["nama"] ?></h1>
    <img src="" alt="">

</body>

</html>