<?
include 'connection.php';
session_start();
$FIO = $_POST['FIO'];
$login = $_POST['login'];
$pass = md5(trim($_POST['pass']));
$role = $_POST['role'];
$image = 'icolog.png';
$user = $mysqli->query("SELECT * FROM `user` WHERE `login` = '$login'");

if (mysqli_num_rows($user) > 0) {
    echo json_encode(array(
        'result' => 'error',
        'type' => 'hasthatlogin'
    ));
} else {
    if ($mysqli->query("INSERT INTO `user`(`login`, `Name`, `password`, `role`, `image`) VALUES ('$login','$FIO','$pass','$role','$image')")) {
        echo json_encode(array(
            'result' => 'success'
        ));
    } else {
        echo json_encode(array(
            'result' => 'error',
            'type' => 'server'
        ));
    }
}
?>
