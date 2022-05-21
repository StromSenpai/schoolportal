<?
include 'connection.php';
session_start();
if (isset($_SESSION['UID'])) {
    $myUID = $_SESSION['UID'];
    $messlist = $mysqli->query("SELECT * FROM `user` WHERE `UID` != $myUID  ORDER BY `Name`");
    $userData = array();
    $friendslist = $mysqli->query("SELECT * FROM `chats` WHERE `IdHead` = '$myUID' OR `idAdd` = '$myUID'");
    $friendsdata = array();
    while ($result = $messlist->fetch_array()) {
        $userData[] = $result;
    }
    while ($result = $friendslist->fetch_array()) {
        $friendsdata[] = $result;
    }
    $countfriends = count($friendsdata);
    if ($countfriends == 0) {
        // если у тебя нет нискем открытого чата
?> <div class="block-message">
            <div>
                <div>Для того чтобы начать с кем либо общаться вы должны добавить человека в чат</div>
                <a href="/users.php">найти собеседника.</a>
            </div>
        </div>
        <?
    } else {
        foreach ($friendsdata as $onefriend) {
            if ($onefriend['IdHead'] == $myUID) {
                $userUID = $onefriend['idAdd'];
            } else {
                $userUID = $onefriend['IdHead'];
            }
        ?>
            <?
            $messages = $mysqli->query("SELECT * FROM `chat` WHERE `idSell` = '$userUID' AND `idGet` = '$myUID' OR `idGet` = '$userUID' AND `idSell` = '$myUID' ORDER BY `date` DESC LIMIT 1");
            $lastmess = $messages->fetch_assoc();
            $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = $userUID");
            $oneuser = $user->fetch_assoc();
            ?>
            <!-- список открытых чатов -->
            <div class="block-char pointer" onclick="StartChat(this)" uidpersone="<? echo $oneuser['UID'] ?>">
                <div class="photo-list">
                    <div class="img-char">
                        <img src="assets/images/<? echo $oneuser['image'] ?>" alt="аватар пользователя" class="avatar">
                    </div>
                </div>
                <div class="mess-list">
                    <div class="text-list">
                        <div class="name-char">
                            <? echo $oneuser['Name'] ?>
                        </div>
                        <div class="last-mess">
                            <?  $message = $lastmess['Message'];
                            if ($lastmess['idSell'] == $myUID) { ?>

                                Вы: <?
                                   
                                    if (mb_strlen($message, 'UTF-8') > 20) {
                                        echo mb_substr($message, 0, 21, 'UTF-8') . "...";
                                    } else {
                                        echo $message;
                                    }
                                    ?>
                            <? }
                            if ($lastmess['idSell'] != $myUID) {
                            ?>
                                <? 
                                if (mb_strlen($message, 'UTF-8') > 20) {
                                    echo mb_substr($message, 0, 21, 'UTF-8') . "...";
                                } else {
                                    echo $message;
                                }
                                ?>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
    <?
        }
    }
} else { ?>
<!-- если ты без акка -->
    <div class="block-message">
        <div>
            Для того чтобы пользоваться мессенджером вы должны быть авторизованны
            <a href="/login.php">войти?</a>
        </div>
    </div>
<?
} ?>