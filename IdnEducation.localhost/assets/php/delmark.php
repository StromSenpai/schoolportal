<?
// для удаления оценки обработка вся на фронтенде
session_start();
include 'connection.php';
$idmark = $_POST['idmark'];
$mysqli->query("DELETE FROM `marks` WHERE `id` = $idmark");
?>