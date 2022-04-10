<?php
session_start();
require "functions.php";
$blog = querysql("SELECT artikel.nama AS an, artikel.konten, artikel.gambar, kategori.nama AS kn, artikel.id AS ai FROM (blog INNER JOIN artikel ON blog.id_artikel = artikel.id) INNER JOIN kategori ON blog.id_kategori = kategori.id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="shortcut icon" href="assets/img/ghaza.jpg" type="image/x-icon">
    <title>Ghaza Blog &copy;</title>
</head>

<body>
    <div style="display: block; text-align: center; margin-top: 60px; margin-bottom: 30px;">
        <h1>WELCOME TO <u>GHAZA BLOG</u></h1>
        <p>This blog is created by html + css + javascript</p>
    </div>
    div
    <div class="wrapper">
        <button onclick="login(true)">LOGIN</button>
    </div>
    <div id="login" class="modal">
        <div class=" modal__content">
            <form class="login-form" action="javascript:void(0);">
                <h1>LOGIN ADMIN</h1>
                <div class="form-input-material">
                    <input type="text" name="username" id="username" placeholder="USERNAME" autocomplete="off" class="form-control-material" required />
                </div>
                <div class="form-input-material">
                    <input type="password" name="password" id="password" placeholder="PASSWORD" autocomplete="off" class="form-control-material" required />
                </div>
                <button type="submit" class="submit">LOGIN</button>
            </form>
            <button class="modal__close" onclick="login(false)">&times;</button>
        </div>
    </div>
    <div class="container">
        <?php foreach ($blog as $list) : ?>
            <div class="card">
                <div class="card__header">
                    <img src="assets/img/<?= preg_replace('/\s+/', '-', $list["an"]) ?>.jpg" alt="card__image" class="card__image" width="600">
                </div>
                <div class="card__body">
                    <span class="tag tag-blue"><a href="category.php?nama=<?= $list["kn"] ?>"><?= $list["kn"] ?></a></span>
                    <h4><a href="article.php?id=<?= $list["ai"] ?>"><?= $list["an"] ?></a></h4>
                    <p><?= $list["konten"] ?></p>
                </div>
                <div class="card__footer">
                    <div class="user">
                        <img src="assets/img/ghaza.jpg" alt="user__image" class="user__image">
                        <div class="user__info">
                            <h5>ADMIN</h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="footer">
        <h1>&copy; Respect the copyright act and follow the laws.</h1>
    </div>
    <script>
        var log = document.getElementById("login");

        function login(para) {
            log.classList.remove("active");
            if (para == true) {
                log.classList.add("active");
            }
        }
    </script>
</body>

</html>