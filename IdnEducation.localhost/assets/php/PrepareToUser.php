<?
// для того чтобы не пользоваться формами
session_start();
include 'connection.php';
$uid = $_POST['uid'];
$user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$uid'");
$oneuser = $user->fetch_assoc();
$roleid = $oneuser['role'];
$role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$roleid'");
$onerole = $role->fetch_assoc();
$_SESSION['UIDUser'] = $uid;
$_SESSION['UserName'] = $oneuser['Name'];
$_SESSION['UserImg'] = $oneuser['image'];
$_SESSION['UserRoleid'] = $oneuser['role'];
$_SESSION['UserRole'] = $onerole['roleName'];
?>
