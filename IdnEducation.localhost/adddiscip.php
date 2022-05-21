<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <? include 'assets/php/connectassets.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление дисциплины</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <div class="head-parag">
            Добавление дисциплины
        </div>
        <!-- Блок заполнения -->
        <div class="block-registration">
            <!-- Название дисциплины вписывать -->
            <input type="text" name="Class" id="Discipline" placeholder="Дисциплина" autocomplete="off">

            <!-- Роли которые могут пользоваться всеми возможностями админ и директор добавляются по умолчанию-->
            <select id="comboboxroles" class="combobox" name="who">
                <? include 'assets/php/connection.php';
                session_start();
                $roles = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` != 'A' AND `roleid` != 'D' AND `roleid` != 'S'");
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
                <div class="btn pointer" id="setclass">
                    Добавить
                </div>
            </div>
            <div id="error">

            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#setclass').on('click', function() {
            var namediscip = $('#Discipline').val();
            var e = document.getElementById('comboboxroles');
            var idroles = e.value + ",A,D";
            $.ajax({
                url: "assets/php/create_disciplide.php",
                type: "post",
                dataType: "json",
                data: {
                    "NamDiscip": namediscip,
                    "IdRoles": idroles
                },
                success: function(data) {
                    if (data.result == "success") {
                        $('#Discipline').val(null);
                        $('#error').removeClass('error');
                        $('#error').addClass('success');
                        $('#error').html('Дисциплина добавлена успешно');
                    } else {
                        if (data.type == "thatdisciplinehas") {
                            $('#error').removeClass('success');
                            $('#error').addClass('error');
                            $('#error').html('Такая дисциплина уже существует');
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