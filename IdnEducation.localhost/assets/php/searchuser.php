<?
// для поиска пользователя
include 'connection.php';
session_start();
$text = $_POST['text'];
$myUID = $_SESSION['UID'];
$userlist = $mysqli->query("SELECT * FROM `user` WHERE `UID` != $myUID AND `Name` LIKE '%$text%'");
$userdata = array();
while ($result = $userlist->fetch_array()) {
    $userdata[] = $result;
}
foreach ($userdata as $oneuser) {
?>
    <!-- список пользователей -->
    <div class="block-user pointer" uid='<? echo $oneuser['UID'] ?>' onclick="togo(this)">
    <!-- фотка -->
        <div class="user-photo">
            <img src="/assets/images/<? echo $oneuser['image'] ?>" alt="аватар" class="avatar">
        </div>
        <!-- имя -->
        <div class="user-name">
            <? echo $oneuser['Name'] ?>
        </div>
        <!-- должность аля администратор -->
        <div class="user-role">
            <? $idrole = $oneuser['role'];
            $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$idrole'");
            $resultate = $role->fetch_assoc();
            echo $resultate['roleName'];
            ?>
        </div>
    </div>
<?
}
?>