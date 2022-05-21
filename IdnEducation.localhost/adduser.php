<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <? include 'assets/php/connectassets.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <div class="head-parag">
            Регистрация
        </div>
        <!-- Блок регистрации -->
        <div class="block-registration">
            <!-- ФИО -->
            <input type="text" name="FIO" id="FIO" placeholder="ФИО" autocomplete="off">
            <!-- Логин -->
            <input type="text" name="login" id="login" placeholder="Логин" autocomplete="off">
            <!-- Пароль -->
            <input type="text" name="password" id="password" placeholder="Пароль" autocomplete="off">
            <!-- Комбобокс с должностями аля ролями -->
            <select id="comboboxroles" class="combobox" name="who">
                <? include 'assets/php/connection.php';
                session_start();
                $roles = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` != 'A'");
                $Allroles = array();
                while ($result = $roles->fetch_array()) {
                    $Allroles[] = $result;
                }
                foreach ($Allroles as $onerole) {
                ?>
                    <option value="<? echo $onerole['roleid'] ?>"><? echo $onerole['roleName'] ?></option>
                <? } ?>
            </select>
            <div class="actions">
                <div class="btn pointer" id="registration">
                    Зарегистрировать
                </div>
            </div>
            <div id="error">

            </div>
        </div>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        // регистрация
        $(document).ready(function() {
            $('#registration').click(function() {
                var Fam = $('#FIO').val();
                var login = $('#login').val();
                var pass = $('#password').val();
                var e = document.getElementById('comboboxroles');
                var role = e.value;
                $.ajax({
                    url: "assets/php/create_user.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        "FIO": Fam,
                        "login": login,
                        "pass": pass,
                        "role": role
                    },
                    success: function(data) {
                        if (data.result == "success") {
                            $('#FIO').val(null);
                            $('#login').val(null);
                            $('#password').val(null);
                            $('#error').removeClass('error');
                            $('#error').addClass('success');
                            $('#error').html('Добавление пользователя прошло успешно');
                        } else {
                            if (data.type == "hasthatlogin") {
                                $('#error').removeClass('success');
                                $('#error').addClass('error');
                                $('#error').html('Пользователь с таким логином уже существует');
                            } else {
                                $('#error').removeClass('success');
                                $('#error').addClass('error');
                                $('#error').html('Ошибка на стороне сервера попробуйте перепроверить правильность введенных данных');
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>