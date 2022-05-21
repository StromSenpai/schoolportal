<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <? include 'assets/php/connectassets.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню админа</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <!-- меню админа аля добавить пользователя или записать ученика в какой либо класс пока не сделано -->
    <? session_start();
    if (isset($_SESSION['UID'])) {
        if ($_SESSION['role'] == 'A') {
    ?>
            <div class="container">
                <div class="head-parag">
                    Меню Админа
                </div>
                <a href="/adduser.php" class="btn pointer">Добавить пользователя</a>
                <a href="/addinclass.php" class="btn pointer">Добавить ученика в класс</a>
                <a href="/adddiscip.php" class="btn pointer">Добавить дисциплину</a>
                <a href="/addroles.php" class="btn pointer">Добавить должности</a>
            </div>
        <?
        } else {
        ?> <div class="block-message">
                Вы должны обладать правами администратора чтобы пользоваться данным окном
            </div>
        <?
        }
    } else {
        ?>
        <div class="block-message">
            Вы не авторизованы <a href="/login.php"> Войти?</a>
        </div>
    <?
    }
    ?>

</body>

</html>