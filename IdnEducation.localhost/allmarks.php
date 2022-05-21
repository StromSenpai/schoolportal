<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php';
    session_start(); ?>
    <title>
        Оценки: <? echo $_SESSION['NameDiscip'] ?>
    </title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div id="start">
        <? include 'assets/php/marks-list.php' ?>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        var idmark = 0;
        // для того чтобы выделить оценку для удаления 
        function check(i) {
            $('.checked').removeClass('checked');
            $(i).addClass('checked');
            idmark = $(i).attr('idmark');
        }
        // скрипт кнопок
        function del() {
            if (idmark != 0) {
                $.post("assets/php/delmark.php", {
                    idmark: idmark
                }, function() {
                    alert("Оценка удалена");
                    idmark = 0;
                    $.post("assets/php/marks-list.php",
                        function(data) {
                            $('#start').html(data);
                        })
                });
            } else {
                alert("Выберите оценку!");
            }

        }

        function setmark(i) {
            var ididscip = $(i).attr('iddiscipline');
            $(location).attr('href', '/setmark.php?' + ididscip);
        }
    </script>
</body>

</html>