<?
session_start();
include 'connection.php';
if (isset($_SESSION['UID'])) {
?>
<!-- обёртка для личной странички -->
    <div class="kab-block">
        <!-- контент профиля -->
        <div class="profile-kab">
            <!-- картинка -->
            <div class="img-kab">
                <img src="/assets/images/<? echo $_SESSION['img'] ?>" alt="аватарка" class="photo avatar">
            </div>
            <!-- ФИО -->
            <div class="name-profile">
                <?
                echo $_SESSION['Name'];
                ?>
            </div>
            <!-- должность аля администратор -->
            <div class="role-profile">
                <?
                $role = $_SESSION['role'];
                $roles = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$role'");
                $onerole = $roles->fetch_assoc();
                echo $onerole['roleName'];
                ?>
            </div>
        </div>
        <!-- кнопки -->
        <div class="actions">
            <?
            if ($_SESSION['role'] == 'A' || $_SESSION['role'] == 'D' || strpbrk($_SESSION['role'], "T")) {
            ?>
                <div class="action">
                    <a href="/createblog.php" class="btn pointer"> Написать блог</a>
                </div>
            <?
            }
            if ($_SESSION['role'] == 'A' || $_SESSION['role'] == 'D') {
            ?>
                <div class="action">
                    <a href="/createnews.php" class="btn pointer"> Написать новость</a>
                </div>
            <?
            }
            ?>
            <div class="action">
                <div class="btn pointer" id="exitbtn">
                    Выйти
                </div>
            </div>
        </div>
    </div>
    <!-- для отображения блога от самого пользователя -->
    <? if ($_SESSION['role'] == 'A' || $_SESSION['role'] == 'D' || strpbrk($_SESSION['role'], "T")) { ?>
        <? $myuid = $_SESSION['UID'];
        $sql = $mysqli->query("SELECT * FROM `blog` WHERE `userid` = $myuid ORDER BY `date` DESC");
        $myblog = array();
        while ($result = $sql->fetch_array()) {
            $myblog[] = $result;
        }
        if (empty($myblog)) {
        ?> <div class="container">
                <div class="head-parag">
                    Нет записей
                </div>
            </div><?
                } else { ?>
            <div class="container">
                <div class="head-parag">
                    МОЙ БЛОГ
                </div>
                <div class="myblog" id="blog-start">
                    <? include 'myblog.php' ?>
                </div>
            </div>
    <? }
            }
        } else {
    ?>
    <!-- если ты не вошел в акк -->
    <div class="container">
        <div class="block-message">
            Вы не авторизованы <a href="/login.php"> Войти?</a>
        </div>
    </div>
<?
        }
?>