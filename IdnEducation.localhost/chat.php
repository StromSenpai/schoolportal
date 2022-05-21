<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title>
        <?
        include 'assets/php/connection.php';
        session_start();
        $uidChar = $_SESSION['UIDChar'];
        $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = $uidChar");
        $result = $user->fetch_assoc();
        echo $result['Name']
        ?>
    </title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <!-- вывод того с кем общаешься -->
    <div class="container">
        <!-- обертка -->
    <div class="head-chat">
        <!-- фото -->
            <div class="img-chat">
                <img src="/assets/images/<? echo $result['image'] ?>" alt="аватарка" class="avatar">
            </div>
            <!-- имя -->
            <div class="name-chat">
                <div class="name-char"><? echo $result['Name'] ?></div>
            </div>
        </div>
        <!-- линия -->
        <div class="line-black" style="width: 16%; margin-top: 1vh; align-self: center;">

        </div>
    </div>
    <div class="container">
        <!-- блок для чата -->
        <div class="chat-list" id="chatingflow">
            <?include 'assets/php/messages-list.php'?>
        </div>
        <!-- для того чтобы отправить сообщение -->
        <div class="sell-message">
            <input type="text" name="message" id="message" class="messages" autocomplete="off">
            <input type="button" value="Отправить" id="sellmessage" class="mess-btn pointer" idsell="<? echo $_SESSION['UID'] ?>" idget="<? echo $_SESSION['UIDChar'] ?>">
        </div>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        // при нажатии на энтер в момент ввода сообщения
        $('#message').keyup(function(event) {
            if (event.keyCode == 13) {
                var btn_sell = $('#sellmessage');
                var idsell = btn_sell.attr('idsell');
                var idget = btn_sell.attr('idget');
                var textmessage = $('#message').val();
                if (textmessage != "") {
                    btn_sell.val('Отправка...');
                    $.ajax({
                        url: "/assets/php/sell_message.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            "idsell": idsell,
                            "idget": idget,
                            "textMessage": textmessage
                        },
                        success: function(data) {
                            if (data.result == "success") {
                                btn_sell.val('Отправить');
                                $('#message').val(null);
                                $.post('assets/php/messages-list.php', {
                                    UID: idsell,
                                    UIDuser: idget
                                }, function(data) {
                                    if (data) {
                                        $('#chatingflow').html(data);
                                        scrollDiv.scrollTo(0, scrollDiv.scrollHeight);
                                    }
                                });
                            } else {
                                btn_sell.val('Ошибка');
                            }
                        }
                    });
                }
            }
        });

        // при нажатии на кнопку
        $('#sellmessage').on('click', function() {
            if ($('#message').val() != "") {
                var btn_sell = $('#sellmessage');
                var idsell = btn_sell.attr('idsell');
                var idget = btn_sell.attr('idget');
                var textmessage = $('#message').val();
                if (textmessage != "") {
                    btn_sell.val('Отправка...');
                    $.ajax({
                        url: "/assets/php/sell_message.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            "idsell": idsell,
                            "idget": idget,
                            "textMessage": textmessage
                        },
                        success: function(data) {
                            if (data.result == "success") {
                                btn_sell.val('Отправить');
                                $('#message').val(null);
                                $.post('assets/php/messages-list.php', {
                                    UID: idsell,
                                    UIDuser: idget
                                }, function(data) {
                                    if (data) {
                                        $('#chatingflow').html(data);
                                        scrollDiv.scrollTo(0, scrollDiv.scrollHeight);
                                    }
                                });
                            } else {
                                btn_sell.val('Ошибка');
                            }
                        }
                    })
                }
            }
        });
        // прочее
        var scrollDiv = document.getElementById("chatingflow");
        scrollDiv.scrollTo(0, scrollDiv.scrollHeight);
        setInterval(function() {
            var btn_sell = $('#sellmessage');
            var idsell = btn_sell.attr('idsell');
            var idget = btn_sell.attr('idget');
            $.post('assets/php/messages-list.php', {
                UID: idsell,
                UIDuser: idget
            }, function(data) {
                if (data) {
                    $('#chatingflow').html(data);
                }
            });
        }, 500);
    </script>
</body>

</html>