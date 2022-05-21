<? include 'connection.php';
// отправка сообщения
$message = $_POST['textMessage'];
$idSell = $_POST['idsell'];
$idGet = $_POST['idget'];
$date = date("Y-m-d H:i:s");
if ($mysqli->query("INSERT INTO `chat`(`Message`, `date`, `idSell`, `idGet`) VALUES ('$message', '$date', '$idSell', '$idGet')")) {
    echo json_encode(array(
        'result'    => 'success'
    ));
} else {
    echo json_encode(array(
        'result'    => 'error'
    ));
    echo "Ошибка: " . $mysqli->error;
}
?>