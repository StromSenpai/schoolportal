<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include '/OpenServer/domains/IdnEducation.localhost/assets/php/connectassets.php' ?>
    <title>Авторизация</title>
</head>

<body>
    <? include '/OpenServer/domains/IdnEducation.localhost/assets/php/header.php' ?>
    <div class="container">
        <!-- обертка для авторизации -->
        <div class="block-log">
            <!-- оглавление авторизации -->
            <div class="head-log">
                Авторизация
            </div>
            <!-- форма заполения для авторизации -->
            <div class="form-login center column">
                <input type="text" id="login" placeholder="Имя">
                <input type="password" name="password" id="pass" placeholder="Пароль">
            </div>
            <!-- кнопка -->
            <input type="button" value="Войти" id="btnlog" class="btn pointer">
            <!-- для вывода ошибки -->
            <div id="error">

            </div>
        </div>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        // обработка нажатия на энтер
        $(document).keyup(function(event) {
            if (event.keyCode == 13) {
                var login = $('#login').val();
                var pass = $('#pass').val();
                $.ajax({
                    url: "assets/php/autorization.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        "login": login,
                        "pass": pass
                    },
                    success: function(data) {
                        if (data.result == "success") {
                            $(location).attr("href", "/lk.php");
                        } else {
                            $('#login').val(null);
                            $('#pass').val(null);
                            $('#error').html(data.html);
                        }
                    }
                });
            }
        });
        // обработка нажатия на саму кнопку
        $('#btnlog').on('click', function() {
            var login = $('#login').val();
            var pass = $('#pass').val();
            $.ajax({
                url: "assets/php/autorization.php",
                type: "post",
                dataType: "json",
                data: {
                    "login": login,
                    "pass": pass
                },
                success: function(data) {
                    if (data.result == "success") {
                        $(location).attr("href", "/lk.php");
                    } else {
                        $('#login').val(null);
                        $('#pass').val(null);
                        $('#error').html(data.html);
                    }
                }
            });
        });
    </script>
</body>

</html>