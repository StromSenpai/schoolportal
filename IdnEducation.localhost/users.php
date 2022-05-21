<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php'; ?>
    <title>Пользователи</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
   
    <div class="container">
    <?session_start();
    if (isset($_SESSION['UID'])){?>
    <!-- поиск пользователей -->
        <div class="search">
            <!-- ввод текста -->
            <input type="text" name="searchtext" id="searchtext" placeholder="Поиск пользователя">
            <!-- кнопка -->
            <div class="btn pointer" id="searchbtn">
                Найти
            </div>
        </div>
        <?}?>
        <!-- для списка -->
        <div id="searchstart">
            <? include 'assets/php/user-list.php' ?>
        </div>
    </div>
   
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#searchbtn').on('click', function() {
            var searchtext = $('#searchtext').val();
            $.post("assets/php/searchuser.php", { 
                    text: searchtext
                },
                function(data) {
                    if (data) {
                        $('#searchstart').html(data);
                    }
                });
        });
        // сделано специально для динамической страницы
        function togo(i) {
            var user = $(i);
            var uid = user.attr('uid');
            $.post("assets/php/PrepareToUser.php", {
                    uid: uid
                },
                function() {
                    $(location).attr('href', '/user.php?' + uid);
                });
        }
    </script>
</body>

</html>