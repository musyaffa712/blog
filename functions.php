<?php
$conn = mysqli_connect("localhost", "root", "", "db_blog");
function querysql($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload()
{
    $name = $_FILES['icon']['name'];
    $size = $_FILES['icon']['size'];
    $error = $_FILES['icon']['error'];
    $tmp = $_FILES['icon']['tmp_name'];
    // cek gambar gk diupload
    if ($error === 4) {
        echo "<script>alert('pilih foto dulu!');</script>";
        return false;
    }
    // cek ngupload apa
    $formatvalid = ['jpg', 'jpeg', 'png'];
    $formaticon = explode('.', $name);
    $formaticon = strtolower(end($formaticon));
    if (!in_array($formaticon, $formatvalid)) {
        echo "<script>alert('kamu bukan upload foto');</script>";
        return false;
    }
    // batasi size
    if ($size > 2000000) {
        echo "<script>alert('ukuran fotonya terlalu gede');</script>";
        return false;
    }
    // acak nama file
    $newname = uniqid();
    $newname .= ".";
    $newname .= $formaticon;
    // upload ke server
    move_uploaded_file($tmp, 'assets/img/' . $newname);
    return $newname;
}

function create()
{
}

function reg($data)
{
    global $conn;
    $nama = $data["nama"];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah ada');
        </script>";
        return false;
        exit;
    }
    // cek konfirmasi password
    if ($password2 !== $password) {
        echo "<script>
        alert('konfirmasi salah');
        </script>";
        return false;
        exit;
    }
    $icon = upload();
    if ($icon == false) {
        return false;
    }
    // acak password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // memasukkan user ke database
    mysqli_query($conn, "INSERT INTO users VALUES(NULL, '$nama', '$username', '$password', '$icon')");
    return mysqli_affected_rows($conn);
}
