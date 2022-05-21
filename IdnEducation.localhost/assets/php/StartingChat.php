<?
include 'connection.php';
// для того чтобы начать чат
session_start();
$uid = $_SESSION['UID'];
$uidstartchat = $_POST['uid'];
$mysqli->query("INSERT INTO `chats`(`IdHead`, `idAdd`) VALUES ('$uid','$uidstartchat')"); 

?>