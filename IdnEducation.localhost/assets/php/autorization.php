<?php
include 'connection.php';
session_start();
if (isset($_POST['login']) && isset($_POST['pass'])) {
    if ($_POST['login'] == null || $_POST['pass'] == null) {
        echo json_encode(array(
            'result'  => 'error',
            'html'    => "<div class='error'>
            Пустые поля ввода
        </div>"
        ));
    } else {
        $login = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['login']));
        $pass = md5(trim($_POST['pass']));
        $sql = $mysqli->query("SELECT * FROM `user` WHERE login = '$login' AND password = '$pass' LIMIT 1");
        if (mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['UID'] = $row['UID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['login'] = $row['login'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['img'] = $row['image'];
            echo json_encode(array(
                'result' => "success",
            ));
        } else {

            echo json_encode(array(
                'result'  => 'error',
                'html'    =>  "<div class='error'>
            Неверно введен логин или пароль
        </div>"
            ));
        }
    }
}
