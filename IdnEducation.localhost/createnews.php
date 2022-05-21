<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title>Создание новости</title>
</head>

<body>
    <? include 'assets/php/header.php';
    session_start(); ?>
    <div class="container">
        <!-- обертка для формы заполнения новости -->
        <div class="block-bloging">
            <!-- да -->
            <div class="head-bloging">
                Написание новости
            </div>
            <!-- форма заполнения -->
            <div class="form-bloging">
                <input type="text" name="text" id="messagehead" placeholder="Оглавление новости" autocomplete="off">
                <textarea name="text" id="message" cols="30" rows="10"></textarea>
                <!-- счетчик тут такой же как и у блога лучше не трогать его -->
                <div class="counter" id="counter">
                    0/2000 символов
                </div>
            </div>
            <!-- расположение для кнопки -->
            <div class="act-bloging">
                <!-- кнопка -->
                <div class="btn pointer" id="sellblogbtn" UID="<? echo $_SESSION['UID'] ?>">
                    Выложить
                </div>
            </div>
            <!-- для вывода ошибки -->
            <div id="messagebox">
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var countblock = $('#counter');
            // сам счетчик
            $('#message').keydown(function(e) {
                var text = $(this).val();
                var countstart = text.length;
                countblock.html(countstart + "/2000 символов");
                var max = 2000;
                if (e.which < 0x20) {
                    return;
                }
                if (this.value.length == max) {
                    e.preventDefault();
                } else if (this.value.length > max) {
                    this.value = this.value.substring(0, max);
                }
            });
            // оправка новости
            $('#sellblogbtn').on('click', function() {
                var textmessage = $('#message').val();
                var messagehead = $('#messagehead').val();
                if (textmessage != "" || messagehead != "") {
                    var uid = $(this).attr('UID');
                    $.ajax({
                        url: "assets/php/sell_news.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            "MessageHead": messagehead,
                            "TextMessage": textmessage,
                            "UID": uid
                        },
                        success: function(data) {
                            if (data.result == "success") {
                                $('#messagebox').removeClass('error');
                                $('#messagebox').toggleClass('success');
                                $('#messagebox').html('Новость выложена!');
                                $('#message').val(null);
                                $('#messagehead').val(null);
                                setTimeout(function() {
                                    $('#messagebox').removeClass('success');
                                    $('#messagebox').html('');
                                }, 10000);
                            } else {
                                $('#messagehead').val(null);
                                $('#message').val(null);
                                $('#messagebox').html(data.html);
                            }
                        }
                    });
                } else {
                    $('#messagebox').removeClass('success');
                    $('#messagebox').toggleClass('error');
                    $('#messagebox').html('Пустое поле ввода');
                    setTimeout(function() {
                        $('#messagebox').removeClass('error');
                        $('#messagebox').html('');
                    }, 10000)
                }
            });
        });
    </script>
</body>

</html>