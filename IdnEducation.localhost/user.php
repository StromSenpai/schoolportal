<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?include 'assets/php/connectassets.php'?>
    <title>
        <?
        session_start();
        echo $_SESSION['UserName'];
        ?>
    </title>
</head>

<body>
    <!-- страница профиля -->
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <? include 'assets/php/profile.php' ?>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        // обработка нажатия начала чата или переход в сам чат
        function StartChat(i){
            var uid = $(i).attr('uid');
            var writeorstart = $(i).html();
            // вот из-за чего нужно чтобы кнопки были такого формата сам 15 минут сидел и думал че не так
            if (writeorstart == 'Написать'){
                $.post("assets/php/prepareTochat.php",
                {
                    uid: uid
                },
                function(){
                    $(location).attr("href", '/chat.php?' + uid)
                }
                );
            }else{
                $.post("assets/php/StartingChat.php", 
            {
                uid: uid
            },
            function(){
                $(i).html('Написать');
            });
            }
          
        }
    </script>
</body>

</html>