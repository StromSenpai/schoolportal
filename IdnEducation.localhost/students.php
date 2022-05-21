<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title>Ученики</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <?
        if (isset($_SESSION['UID'])) {
            if ($_SESSION['role'] == 'A' || strpbrk($_SESSION['role'], 'T')  || $_SESSION['role'] == 'D') {
                $stydents = $mysqli->query("SELECT * FROM `user` WHERE `role` = 'S'");
                $allstydents = array();
                while ($result = $stydents->fetch_array()) {
                    $allstydents[] = $result;
                }
                foreach ($allstydents as $onestydent) :
                    $uid = $onestydent['UID'];
                    $class = $mysqli->query("SELECT * FROM `classes` WHERE `UIDStud` = '$uid'");
                    $result = $class->fetch_assoc();
        ?>
        <!-- список учеников для учителей и других пользователей выше ученика-->
                    <div class="block-user pointer" onclick="startmark(this)" uid="<? echo $onestydent['UID'] ?>">
                        <!-- фото -->
                    <div class="user-photo">
                            <img src="assets/images/<? echo $onestydent['image'] ?>" alt="аватар" class="avatar">
                        </div>
                        <!-- имя с классом -->
                        <div class="user-name">
                            <? echo $onestydent['Name'] . " Класс: " ?> <? echo $result['class'] ?>
                        </div>
                    </div>

                <?
                endforeach;
            } else {
                $uid = $_SESSION['UID'];
                $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$uid'");
                $result = $user->fetch_assoc();
                $class = $mysqli->query("SELECT * FROM `classes` WHERE `UIDStud` = '$uid'");
                $resultclass = $class->fetch_assoc();
                ?>
                <!-- аля список для ученика где только он сам тут тоже самое-->
                <div class="block-user pointer" onclick="startmark(this)" uid="<? echo $uid ?>">   
                <div class="user-photo">
                        <img src="assets/images/<? echo $result['image'] ?>" alt="аватар пользователя" class="avatarё">
                    </div>
                    <div class="user-name">
                            <? echo $result['Name'] . " Класс: " ?> <? echo $resultclass['class'] ?>
                    </div>
                </div>
            <? }
        } else {
            ?>
            <!-- если не вошел в акк -->
           <div class="block-message">
            Вы не авторизованы <a href="/login.php"> Войти?</a>
        </div>
        <?
        }
        ?>
    </div>

    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function startmark(i) {
            var uid = $(i).attr('uid');
            $.post(
                'assets/php/preparetomarks.php', {
                    UID: uid
                },
                function() {
                    $(location).attr('href', '/marks.php');
                }
            );
        };
    </script>
</body>

</html>