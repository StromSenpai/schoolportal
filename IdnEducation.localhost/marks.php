<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title>Оценки</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <? if ($_SESSION['role'] == 'S') { ?>
            <!-- типо как профиль только с оценками для ученика-->
            <div class="kab-block">
                <!-- профиль -->
                <div class="profile-kab">
                        <?
                        $UIDstud = $_SESSION['UIDStud'];
                        $stud = $mysqli->query("SELECT * FROM `user` WHERE `UID` = $UIDstud");
                        $result = $stud->fetch_assoc();
                        $class = $mysqli->query("SELECT * FROM `classes` WHERE `UIDStud` = '$UIDstud' ");
                        $resultclass = $class->fetch_assoc();
                        ?> 
                        <!-- фотка -->
                        <div class="img-kab">
                            <img src="/assets/images/<? echo $result['image']; ?>" alt="" class="avatar">
                        </div>
                        <!-- имя -->
                        <div class="name-profile">
                            <?
                            echo $result['Name'];
                            ?>
                        </div>
                        <!-- я заморачиваться не стал просто вместо должности класс вписал -->
                        <div class="role-profile">
                            <? echo "Класс: " . $resultclass['class']; ?>
                        </div>
                    <?
                    $disc = $mysqli->query("SELECT * FROM `discipline` ORDER BY `id` ");
                    $disciplines = array();
                    while ($result = $disc->fetch_array()) {
                        $disciplines[] = $result;
                    }
                    ?>
                    <!-- табличка -->
                    <div class="table">
                        <!-- оглавление таблички -->
                        <div class="head-table">
                            Оценки:
                        </div>
                        <!-- контент с табличкой -->
                        <table class="contant-table">

                            <? foreach ($disciplines as $onediscip) {

                            ?>
                            <!-- строка -->
                                <tr>
                                    <!-- столбец с названием предмета -->
                                    <td class="disc pointer" uid="<? echo $onediscip['id'] ?>" roles="<? echo $onediscip['roles'] ?>" MyRole="<? echo $_SESSION['role'] ?>" UidStud="<? echo $UIDstud ?>" onclick="AllMarks(this)">
                                        <? echo $onediscip['namediscip'] ?>
                                    </td>
                                    <? $discip = $onediscip['id'];
                                    $marks = $mysqli->query("SELECT * FROM `marks` WHERE `idStud` = $UIDstud and `idDiscip` = '$discip' ORDER BY `date` DESC LIMIT 30");
                                    $marksdata = array();
                                    while ($result = $marks->fetch_array()) {
                                        $marksdata[] = $result;
                                    }
                                    ?>
                                    <? foreach ($marksdata as $onemark) { ?>
                                        <!-- столбец с оценкой лучше саму структуру не трогать в ксс можно -->
                                        <td class="<?
                                                    if ($onemark['mark'] > 3) {
                                                        echo "goodmark";
                                                    }
                                                    if ($onemark['mark'] == 3) {
                                                        echo "midmark";
                                                    }
                                                    if ($onemark['mark'] < 3) {
                                                        echo "badmark";
                                                    }
                                                    ?>">
                                            <? echo $onemark['mark'] ?>
                                        </td>
                                    <? } ?>
                                </tr>
                            <? } ?>
                        </table>
                    </div>
                </div>
            </div>
        <? } else { ?>
            <!-- тоже саме только для других -->
            <div class="kab-block">
                <!-- профиль -->
                <div class="profile-kab">
                   
                        <?
                        $UIDstud = $_SESSION['UIDStud'];
                        $stud = $mysqli->query("SELECT * FROM `user` WHERE `UID` = $UIDstud");
                        $result = $stud->fetch_assoc();
                        $class = $mysqli->query("SELECT * FROM `classes` WHERE `UIDStud` = '$UIDstud' ");
                        $resultclass = $class->fetch_assoc();
                        ?> 
                        <!-- фото -->
                        <div class="img-kab">
                            <img src="/assets/images/<? echo $result['image']; ?>" alt="" class="avatar">
                        </div>
                        <!-- ФИО -->
                        <div class="name-profile">
                            <?
                            echo $result['Name'];
                            ?>
                        </div>
                        <!-- также как и выше -->
                        <div class="role-profile">
                            <? echo "Класс: " . $resultclass['class']; ?>
                        </div>
                    
                    <?
                    $disc = $mysqli->query("SELECT * FROM `discipline` ORDER BY `id` ");
                    $disciplines = array();
                    while ($result = $disc->fetch_array()) {
                        $disciplines[] = $result;
                    }
                    ?>
                    <!-- табличка -->
                    <div class="table">
                        <!-- оглавление -->
                        <div class="head-table">
                            Оценки
                        </div>
                        <!-- табличка и контент -->
                        <table class="contant-table">

                            <? foreach ($disciplines as $onediscip) { ?>
                               <!-- строка -->
                                <tr>
                                    <!-- столбец с предметом -->
                                    <td class="disc pointer" uid="<? echo $onediscip['id'] ?>" roles="<? echo $onediscip['roles'] ?>" UidStud="<? echo $UIDstud ?>" MyRole="<? echo $_SESSION['role'] ?>" onclick="AllMarks(this)">
                                        <? echo $onediscip['namediscip'] ?>
                                    </td>
                                    <? $discip = $onediscip['id'];
                                    $marks = $mysqli->query("SELECT * FROM `marks` WHERE `idStud` = $UIDstud and `idDiscip` = '$discip' ORDER BY `date` DESC LIMIT 30");
                                    $marksdata = array();
                                    while ($result = $marks->fetch_array()) {
                                        $marksdata[] = $result;
                                    }
                                    ?>
                                    <? foreach ($marksdata as $onemark) { ?>
                                        <!-- столбец с оценками помни СТРУКТУРУ САМУ НЕ ТРОГАТЬ полетит все -->
                                        <td class="<?
                                                    if ($onemark['mark'] > 3) {
                                                        echo "goodmark";
                                                    }
                                                    if ($onemark['mark'] == 3) {
                                                        echo "midmark";
                                                    }
                                                    if ($onemark['mark'] < 3) {
                                                        echo "badmark";
                                                    }
                                                    ?>">
                                            <? echo $onemark['mark'] ?>
                                        </td>
                                    <? } ?>
                                </tr>
                            <? } ?>
                        </table>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        // обработка нажатия на предмет аля вывод всех оценок
         function AllMarks(i) {
            var uid = $(i).attr('uid');
            var studuid = $(i).attr('UidStud');
            var roles = $(i).attr('roles');
            var role = $(i).attr('MyRole');
            if (roles.includes(role) || role == "S") {
                $.post('assets/php/PrepareToAllMarks.php', {
                        UID: uid,
                        UIDStud: studuid
                    },
                    function() {
                        $(location).attr('href', '/allmarks.php');
                    }
                );
            } else {
                alert('Вам нельзя пользоваться данной функцией');
            }
        }
    </script>
</body>

</html>