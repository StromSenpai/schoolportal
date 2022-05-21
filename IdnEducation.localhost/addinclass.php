<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <? include 'assets/php/connectassets.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление ученика в класс</title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <div class="head-parag">
            Добавление ученика в класс
        </div>
        <!-- Блок заполнения -->
        <div class="block-registration">
            <!-- класс вписывать -->
            <input type="text" name="Class" id="Classes" placeholder="Класс" maxlength="5" autocomplete="off">

            <!-- Комбобокс с учениками-->
            <select id="comboboxusers" class="combobox" name="who">
                <? include 'assets/php/connection.php';
                session_start();
                $users = $mysqli->query("SELECT * FROM `user` WHERE `role` = 'S'");
                $Allusers = array();
                while ($result = $users->fetch_array()) {
                    $Allusers[] = $result;
                }
                foreach ($Allusers as $oneuser) {
                ?>
                    <option value="<? echo $oneuser['UID'] ?>"><? echo $oneuser['Name'] ?></option>
                <? } ?>
            </select>
            <div class="actions">
                <div class="btn pointer" id="setclass">
                    Зарегистрировать
                </div>
            </div>
            <div id="error">

            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#setclass').on('click', function() {
            var classes = $('#Classes').val();
            var e = document.getElementById('comboboxusers');
            var idstyd = e.value;

            $.ajax({
                url: "assets/php/addorupdateclass.php",
                type: "post",
                dataType: "json",
                data: {
                    "Class": classes,
                    "IdStud": idstyd
                },
                success: function(data) {
                    if (data.result == "success") {
                        if (data.type == "add") {
                            $('#Class').val(null);
                            $('#error').removeClass('error');
                            $('#error').addClass('success');
                            $('#error').html('Добавление ученика в класс прошло успешно');
                        } else {
                            $('#Class').val(null);
                            $('#error').removeClass('error');
                            $('#error').addClass('success');
                            $('#error').html('Замена класса прошла успешно');
                        }
                    } else {
                        if (data.type == "add") {
                            $('#error').removeClass('success');
                            $('#error').addClass('error');
                            $('#error').html('чет хуйня но в добавлении');
                        } else {
                            $('#error').removeClass('success');
                            $('#error').addClass('error');
                            $('#error').html('чет хуйня' + data.pric);
                        }
                    }
                }
            });

        });
    </script>
</body>

</html>