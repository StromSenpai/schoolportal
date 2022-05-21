<?
include 'connection.php';

session_start();
if (isset($_POST['UID']) && isset($_POST['UIDuser'])) {
    $myUID = $_POST['UID'];
    $UIDChar = $_POST['UIDuser'];
} else {
    $myUID = $_SESSION['UID'];
    $UIDChar = $_SESSION['UIDChar'];
}
$userchat = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$UIDChar'");
$user = $userchat->fetch_assoc();
$chat = $mysqli->query("SELECT * FROM `chat` WHERE `idSell` = '$UIDChar' AND `idGet` = '$myUID' OR `idGet` = '$UIDChar' AND `idSell` = '$myUID' ORDER BY `date`");
$chatData = array();
while ($chating = $chat->fetch_array()) {
    $chatData[] = $chating;
}
if (count($chatData) == 0) {
?>
<!-- если сообщений нет -->
    <div class="no-mess">
        Сообщений пока нет. Начните общение первым!
    </div>

    <?
} else {
    foreach ($chatData as $message) {
        if ($message['idSell'] == $user['UID']) {
    ?>
    <!-- сообщение которое отправили тебе -->
            <div class="mess-nomy">
                <!-- само сообщение -->
                <div class="text-mess">
                    <? echo $message['Message'] ?>
                </div>
                <!-- дата и время отправки -->
                <div class="mess-date">
                    <? echo $message['date'] ?>
                </div>
            </div>
        <? }
        if ($message['idSell'] == $myUID) {
        ?>
        <!-- сообщение которое отправил ты -->
            <div class="mess-my">
                <!-- само сообщение -->
                <div class="text-mess">
                    <? echo $message['Message'] ?>
                </div>
                 <!-- дата и время отправки -->
                <div class="mess-date">
                    <? echo $message['date'] ?>
                </div>
            </div>
        <? } ?>
<? }
} ?>