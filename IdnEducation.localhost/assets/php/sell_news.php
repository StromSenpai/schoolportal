<?
include 'connection.php';
// отправка новости в бд
$uid = $_POST['UID'];
$textmessage = $_POST['TextMessage'];
$headmessage = $_POST['MessageHead'];
$date = date("Y-m-d H:i:s");
if (mb_strlen($headmessage) > 256) {
    echo json_encode(array(
        'result' => 'error',
        'html' => 'Оглавление в новости очень большое'
    ));
} else {
    if (mb_strlen($textmessage) > 2000) {
        echo json_encode(array(
            'result' => 'error',
            'html' => 'Сообщение в новости очень большое'
        ));
    } else {
        if ($mysqli->query("INSERT INTO `news`(`UID`, `headname`, `message`, `date`) VALUES ('$uid','$headmessage','$textmessage','$date')")) {
            echo json_encode(array(
                'result'    => 'success',
                'html' => 'Блог выложен'
            ));
        } else {
            echo json_encode(array(
                'result' => 'error',
                'html' => 'Ошибка на стороне сервера попробуйте снова'
            ));
        }
    }
}