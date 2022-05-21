<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include '/OpenServer/domains/IdnEducation.localhost/assets/php/connectassets.php' ?>
    <title>Мессенджер</title>
</head>

<body>
    <? include '/OpenServer/domains/IdnEducation.localhost/assets/php/header.php' ?>
    <div class="container" id="start">
        <? include '/OpenServer/domains/IdnEducation.localhost/assets/php/list-chats.php' ?>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function StartChat(i) {
            var uidpersone = $(i).attr('uidpersone')
            $.post('assets/php/prepareTochat.php', {
                    uid: uidpersone
                },
                function() {
                    $(location).attr('href', '/chat.php?' + uidpersone);
                }
            );
        }
        // обновление списка для повления новых сообщений
        setInterval(function() {
            var uid = <? echo $_SESSION['UID'] ?>;
            $.post("assets/php/list-chats.php", {
                    uid: uid
                },
                function(data) {
                    if (data) {
                        $('#start').html(data);
                    }
                }
            );
        }, 500)
    </script>
</body>

</html>