<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <? include 'assets/php/connectassets.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выставление оценки</title>
</head>

<body>
    <? include 'assets/php/header.php';
    session_start(); ?>
    <div class="container">
        <!-- обертка -->
        <div class="block-setmark">
            <!-- оглавление оценки аля название предмета-->
        <div class="head-setmark">
                <?
                include 'assets/php/connection.php';
                $iddiscip = $_SESSION['UIDDiscip'];
                $discip = $mysqli->query("SELECT * FROM `discipline` WHERE `id` = $iddiscip");
                $onediscip = $discip->fetch_assoc();
                $UIDstud = $_SESSION['UIDStud'];
                $stud = $mysqli->query("SELECT * FROM `user` WHERE `UID` = $UIDstud");
                $result = $stud->fetch_assoc();
                echo $onediscip['namediscip'];
                ?>
            </div>
            <!-- ФИО кому оценку стаивим -->
            <div class="styd-setmark">
                <? echo $result['Name'] ?>
            </div>
            <!-- форма выставления оценки -->
            <div class="setmark">
                <!-- оглавние просто для красоты наверное -->
                <div class="head-setter">
                    Оценка
                </div>
                <!-- показание какую олценку ставишь -->
                <div class="mark midmark" id="setting">
                    3
                </div>
                <!-- ползунок чтобы выбрать оценку -->
                <div class="setter">
                    <input type="range" name="rangemark" min="2" value="3" max="5" oninput="settingmark(this.value)" id="rangemark">
                </div>
                <!-- кнопка -->
                <div class="btn pointer" id="setmark" idstyd="<? echo $UIDstud ?>">
                    Выставить
                </div>
                <div id="error"></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        var mark = 3;
        function settingmark(i) {
            var valuerange = i
            $('#setting').html(valuerange);
        }
        // я хз почему но нужно сначала подвигать ползунок потом ток на кнопку нажать подругому никак
        $('#setmark').on('click', function() {
            var idstyd = $(this).attr('idstyd');
            mark = $('#setting').html();
            $.ajax({
                url: "assets/php/sell_mark.php",
                type: "post",
                dataType: "json",
                data: {
                    "mark": mark,
                    "idstyd": idstyd,
                },
                success: function(data) {
                    if (data.result == "success") {
                        $('#error').removeClass('error');
                        $('#error').addClass('success');
                        $('#error').html('Оценка выставлена');
                        setTimeout(function() {
                            $('#error').removeClass('error');
                            $('#error').removeClass('success');
                            $('#error').html(null)
                        }, 2000)
                    } else {
                        $('#error').removeClass('success');
                        $('#error').addClass('error');
                        $('#error').html('Ошибка на стороне сервера попробуйте еще раз')
                    }
                }
            });
        });
        // для красоты чтобы менялся класс при другой оценке 
        $('#setting').on('DOMSubtreeModified', function() {
            var i = $('#setting').html();
            if (i > 3) {
                $('#setting').removeClass('goodmark');
                $('#setting').removeClass('midmark');
                $('#setting').removeClass('badmark');
                $('#setting').addClass('goodmark');
            }
            if (i == 3) {
                $('#setting').removeClass('goodmark');
                $('#setting').removeClass('midmark');
                $('#setting').removeClass('badmark');
                $('#setting').addClass('midmark');
            }
            if (i < 3) {
                $('#setting').removeClass('goodmark');
                $('#setting').removeClass('midmark');
                $('#setting').removeClass('badmark');
                $('#setting').addClass('badmark')
            }
        });
    </script>
</body>

</html>