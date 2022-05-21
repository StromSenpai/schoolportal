<?
// отправка блога в бд
include 'connection.php';
$uid = $_POST['UID'];
$textmessage = $_POST['TextMessage'];
$date = date("Y-m-d H:i:s");
if (mb_strlen($textmessage) > 256){
    echo json_encode(array(
        'result' => 'error',
        'html' => 'сообщение в блоге очень большое'
    ));
}
else{
    if($mysqli->query("INSERT INTO `blog`(`userid`,`messages`,`date`) VALUES ('$uid', '$textmessage', '$date')")){
        echo json_encode(array(
            'result'    => 'success',
            'html' => 'Блог выложен'
        ));
    } else{
        echo json_encode(array(
            'result' => 'error',
            'html' => 'Ошибка на стороне сервера попробуйте снова'
        ));
    }
}

?>