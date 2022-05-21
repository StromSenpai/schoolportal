<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <? include 'assets/php/connectassets.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление должности</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <div class="head-parag">
            Добавление дисциплины
        </div>
        <!-- Блок заполнения -->
        <div class="block-registration">
            <!-- Название должности вписывать -->
            <input type="text" name="Class" id="RoleName" placeholder="Название" autocomplete="off">
            <!-- Идентификатор должности вписывать-->
            <input type="text" name="Class" id="idRole" placeholder="Идетификатор" maxlength="3"  autocomplete="off">
            <div class="actions">
                <div class="btn pointer" id="setrole">
                    Добавить
                </div>
            </div>
            <div id="error">
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#setrole').on('click', function() {
            var namerole = $('#RoleName').val();
            var idrole = $('#idRole').val()
            $.ajax({
                url: "assets/php/create_role.php",
                type: "post",
                dataType: "json",
                data: {
                    "NamRole": namerole,
                    "IdRole": idrole
                },
                success: function(data) {
                    if (data.result == "success") {
                        $('#RoleName').val(null);
                        $('#idRole').val(null);
                        $('#error').removeClass('error');
                        $('#error').addClass('success');
                        $('#error').html('Добавление должности успешно');
                    } else {
                        if (data.type == "thathasrole") {
                            $('#error').removeClass('success');
                            $('#error').addClass('error');
                            $('#error').html('Такая должность уже существует');
                        } else {
                            $('#error').removeClass('success');
                            $('#error').addClass('error');
                            $('#error').html('Ошибка на стороне сервера проверьте правильность ввода данных');
                        }
                    }
                }
            });

        });
    </script>
</body>

</html>