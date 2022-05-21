<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title>Создание блога</title>
</head>

<body>
    <? include 'assets/php/header.php';
    session_start(); ?>
    <!-- для того чтобы создать блог -->
    <div class="container">
        <div class="block-bloging">
            <!-- типо чтобы все знали где они -->
            <div class="head-bloging">
                Написание блога
            </div>
            <!-- сама форма заполения -->
            <div class="form-bloging">
                <!-- поле заполнения  -->
                <textarea name="text" id="message" cols="30" rows="10"></textarea>
                <!-- счетчик работает через жопу лучше его вообще не трогать (желательно удалить коммент) -->
                <div id="counter">
                    0/256 символов
                </div>
            </div>
            <!-- для расположения кнопки -->
            <div class="act-bloging">
                <!-- сама кнопка -->
                <div class="btn pointer" id="sellblogbtn" UID="<? echo $_SESSION['UID'] ?>">
                    Выложить
                </div>
            </div>
            <!-- для того чтобы вывести ошибку -->
            <div id="messagebox">
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var countblock = $('#counter');
            // вот сам счетчик советую не трогать 
            $('#message').keydown(function(e) {
                var text = $(this).val();
                var countstart = text.length;
                countblock.html(countstart + "/256 символов");
                var max = 256;
                if (e.which < 0x20) {
                    return;
                }
                if (this.value.length == max) {
                    e.preventDefault();
                } else if (this.value.length > max) {
                    this.value = this.value.substring(0, max);
                }
            });

            // для того чтобы выложить блог
            $('#sellblogbtn').on('click', function() {
                var textmessage = $('#message').val();
                if (textmessage != "") {
                    var uid = $(this).attr('UID');
                    $.ajax({
                        url: "assets/php/sell_blog.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            "TextMessage": textmessage,
                            "UID": uid
                        },
                        success: function(data) {
                            if (data.result == "success") {
                                $('#counter').attr('count', '0');
                                $('#counter').html('0/256 символов');
                                $('#messagebox').removeClass('error');
                                $('#messagebox').addClass('success')
                                $('#messagebox').html('Блог выложен!');
                                $('#message').val(null);
                                setTimeout(function() {
                                    $('#messagebox').removeClass('success');
                                    $('#messagebox').html('');
                                }, 10000)
                            } else {
                                $('#message').val(null)
                                $('#messagebox').removeClass('success');
                                $('#messagebox').addClass('error');
                                $('#messagebox').html(data.html);
                            }
                        }
                    });

                } else {
                    $('#messagebox').removeClass('success');
                    $('#messagebox').addClass('error');
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