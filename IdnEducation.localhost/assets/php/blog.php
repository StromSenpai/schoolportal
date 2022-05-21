<?
session_start();
include 'connection.php';
// тут тебе ничего не нужно
$blogs = $mysqli->query("SELECT * FROM `blog` ORDER BY `date` DESC LIMIT 0, 5 ");
$fetchblogs = array();
while ($result = $blogs->fetch_array()) {
    $fetchblogs[] = $result;
}
foreach ($fetchblogs as $oneblog) {
    $uid = $oneblog['userid'];
    $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$uid'");
    $oneuser = $user->fetch_assoc();
    $roleid = $oneuser['role'];
    $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$roleid'");
    $onerole = $role->fetch_assoc();

?> 
<!-- отсюда можешь смотреть -->
<!-- обертка блога -->
    <div class="blog-block pointer" idblog="<? echo $oneblog['id'] ?>" onclick="OpenBlog(this)">
        <!-- оглавление блога -->
    <div class="blog-head">
        <!-- ФИО -->
            <div class="blog-name">
                <? echo $oneuser['Name'] ?>
            </div>
            <!-- типо ниже ФИО аля администратор -->
            <div class="blog-role">
                <? echo $onerole['roleName'] ?>
            </div>
        </div>
        <!-- линия -->
        <div class="line-black" >

        </div>
        <!-- контент блога -->
        <div class="blog-text">
            <? $message = $oneblog['messages'];

            if (mb_strlen($message, 'UTF-8') > 60) {
                echo mb_substr($message, 0, 61, 'UTF-8') . "...";
            } else {
                echo $oneblog['messages'];
            }
            ?>
        </div>
    </div>
<? } ?>