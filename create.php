<?php
session_start();
require "functions.php";
if (isset($_POST["reg"])) {
    if (reg($_POST) > 0) {
        echo "<script>
        alert('userbaru');
        </script>";
    } else {
        echo "<script>
        alert('gagal');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <title>Buat Article</title>
</head>

<body>
    <form action="" method="POST" class=""></form>
</body>

</html>