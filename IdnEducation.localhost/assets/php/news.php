<?
session_start();
include 'connection.php';
$News = $mysqli->query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 0 , 5");
$fetchNews = array();
while ($result = $News->fetch_array()) {
    $fetchNews[] = $result;
}
foreach ($fetchNews as $onenews) {
    $uid = $onenews['userid'];
    $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$uid'");
    $oneuser = $user->fetch_assoc();
    $roleid = $oneuser['role'];
    $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$roleid'");
    $onerole = $role->fetch_assoc();

?>
    <!-- первичный вывод новостей -->
    <div class="news-block pointer" onclick="OpenNews(this)" idNews="<? echo $onenews['id'] ?>">
        <!-- оглавление новости -->
        <div class="news-head">
            <? echo $onenews['headname']; ?>
        </div>
        <!-- линия -->
        <div class="line-black" >

        </div>
        <!-- контент новости -->
        <div class="news-text">
            <? $message = $onenews['message'];
            if (mb_strlen($message, 'UTF-8') > 60) {
                echo mb_substr($message, 0, 60, 'UTF-8') . "...";
            } else {
                echo $onenews['message'];
            } ?>
        </div>
    </div>
<? } ?>