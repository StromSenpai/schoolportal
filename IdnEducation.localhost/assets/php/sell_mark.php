<?php
session_start();
include 'connection.php';
$iddiscip = $_SESSION['UIDDiscip'];
$mark = $_POST['mark'];
$idstyd = $_POST['idstyd'];
$date = date("Y-m-d H:i:s");
if($mysqli->query("INSERT INTO `marks`(`idDiscip`, `idStud`, `mark`, `date`) VALUES ('$iddiscip','$idstyd','$mark','$date')")){
    echo json_encode(array(
        'result' => 'success'
    ));
}else{
    echo json_encode(array(
        'result' => 'error'
    ));
}
?>