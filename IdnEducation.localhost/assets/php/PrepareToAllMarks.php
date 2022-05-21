<?
// это бля того чтобы не пользоваться формами
session_start();
include 'connection.php';
$discip = $_POST['UID'];
$name = $mysqli->query("SELECT * FROM `discipline` WHERE `id` = '$discip'");
$result = $name->fetch_assoc();
$_SESSION['NameDiscip'] = $result['namediscip'];
$_SESSION['UIDDiscip'] = $_POST['UID'];
$_SESSION['UIDStud'] = $_POST['UIDStud'];