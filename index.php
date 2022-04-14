<?php
session_start();
require "functions.php";
$blog = querysql("SELECT users.id, users.icon, users.nama AS un, artikel.nama AS an, artikel.konten, artikel.gambar, kategori.nama AS kn, artikel.id AS ai FROM blog INNER JOIN artikel ON blog.id_artikel = artikel.id INNER JOIN kategori ON blog.id_kategori = kategori.id INNER JOIN users ON blog.id_user = users.id");
$salah = false;
$benar = false;
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
if (isset($_POST["log"])) {
    $u = $_POST["username"];
    $p = $_POST["password"];
    $c = mysqli_query($conn, "SELECT * FROM users WHERE username = '$u'");
    if (mysqli_num_rows($c) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($c);
        if (password_verify($p, $row["password"])) {
            header("Location: index.php");
            $benar = true;
            var_dump($benar);
        } else {
            $salah = true;
        }
    } else {
        $salah = true;
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
    <link rel="shortcut icon" href="assets/img/ghaza.jpg" type="image/x-icon">
    <title>Ghaza Blog &copy;</title>
</head>

<body>
    <?php
    if ($salah === true) {
        echo '<div class="in salah">Username/Password salah</div>';
    }
    ?>
    <div class="welcome">
        <h1>WELCOME TO <u>GHAZA BLOG</u></h1>
        <p>This blog is created by HTML + CSS + Javascript + PHP</p>
    </div>
    <div class="wrapper wlog">
        <button onclick="login(true)">LOGIN</button>
    </div>
    <div class="wrapper wreg">
        <button onclick="register(true)">REGISTERASI</button>
    </div>
    <div id="login" class="modal">
        <div class=" modal__content">
            <form class="login-form" action="" method="POST">
                <h1>LOGIN</h1>
                <div class="form-input-material">
                    <input type="text" name="username" id="username" placeholder="USERNAME" autocomplete="off" class="form-control-material" required />
                </div>
                <div class="form-input-material">
                    <input type="password" name="password" id="password" placeholder="PASSWORD" autocomplete="off" class="form-control-material" required />
                </div>
                <button type="submit" class="submit" name="log">LOGIN</button>
            </form>
            <button class="modal__close" onclick="login(false)">&times;</button>
        </div>
    </div>
    <div id="register" class="modal">
        <div class="modal__content">
            <form class="register-form" action="" enctype="multipart/form-data" method="POST">
                <h1>REGISTERASI</h1>
                <div class="form-input-material">
                    <input type="file" name="icon" id="icon" placeholder="icon" autocomplete="off" class="form-control-material" required />
                </div>
                <div class="form-input-material">
                    <input type="text" name="nama" id="nama" placeholder="YOUR NAME" autocomplete="off" class="form-control-material" required />
                </div>
                <div class="form-input-material">
                    <input type="text" name="username" id="username" placeholder="USERNAME" autocomplete="off" class="form-control-material" required />
                </div>
                <div class="form-input-material">
                    <input type="password" name="password" id="password" placeholder="PASSWORD" autocomplete="off" class="form-control-material" required />
                </div>
                <div class="form-input-material">
                    <input type="password" name="password2" id="password2" placeholder="KONFIRMASI PASSWORD" autocomplete="off" class="form-control-material" required />
                </div>
                <button type="submit" class="submit" name="reg">REGISTERASI</button>
            </form>
            <button class="modal__close" onclick="register(false)">&times;</button>
        </div>
    </div>
    <div class="container">
        <form class="search">
            <input type="search" name="search" placeholder="Search">
            <button type="submit">Search</button>
        </form>
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
                        <img src="assets/img/<?= $list["icon"] ?>" alt="user__image" class="user__image">
                        <div class="user__info">
                            <h5><?= $list["un"] ?></h5>
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
        var reg = document.getElementById("register");

        function login(para) {
            log.classList.remove("active");
            if (para == true) {
                log.classList.add("active");
            }
        }

        function register(para) {
            reg.classList.remove("active");
            if (para == true) {
                reg.classList.add("active");
            }
        }
    </script>
</body>

</html>