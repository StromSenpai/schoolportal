<?
// список пользователей
include 'connection.php';
session_start();
if (isset($_SESSION['UID'])) {
    $myUID = $_SESSION['UID'];
    $userlist = $mysqli->query("SELECT * FROM `user` WHERE `UID` != $myUID ORDER BY `Name`");
    $userdata = array();
    while ($result = $userlist->fetch_array()) {
        $userdata[] = $result;
    }
    foreach ($userdata as $oneuser) {
?>
        <!-- обёртка блока -->
        <div class="block-user pointer" uid='<? echo $oneuser['UID'] ?>' onclick="togo(this)">
            <!-- фото -->
            <div class="user-photo">
                <img src="/assets/images/<? echo $oneuser['image'] ?>" alt="аватар" class="avatar">
            </div>
            <!-- имя -->
            <div class="user-name">
                <? echo $oneuser['Name'] ?>
                <!-- должность аля администратор -->
                <div class="user-role">
                    <? $idrole = $oneuser['role'];
                    $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$idrole'");
                    $resultate = $role->fetch_assoc();
                    echo $resultate['roleName'];
                    ?>
                </div>
            </div>

        </div>
    <?
    }
} else {
    ?>
    <!-- если нет акка -->
    <div class="container">
        <div class="block-message">
            Вы не авторизованы <a href="/login.php"> Войти?</a>
        </div>
    </div>
<?
}
?>