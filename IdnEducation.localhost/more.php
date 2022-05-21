<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title><? session_start();
            include 'assets/php/connection.php';
            if (isset($_SESSION['idBlog'])) {
                echo "Блог";
                $id = $_SESSION['idBlog'];
                $sql = $mysqli->query("SELECT * FROM `blog` WHERE `id` = '$id'");
                $onemore = $sql->fetch_assoc();
                $uid = $onemore['userid'];
                $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$uid'");
                $oneuser = $user->fetch_assoc();
                $idrole = $oneuser['role'];
                $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$idrole'");
                $onerole = $role->fetch_assoc();
            } else {
                echo "Новость";
                $id = $_SESSION['idNews'];
                $sql = $mysqli->query("SELECT * FROM `news` WHERE `id` = '$id'");
                $onemore = $sql->fetch_assoc();
                $uid = $onemore['userid'];
                $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$uid'");
                $oneuser = $user->fetch_assoc();
                $idrole = $oneuser['role'];
                $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$idrole'");
                $onerole = $role->fetch_assoc();
            }
            ?>
    </title>
</head>

<body>
    <? include 'assets/php/header.php' ?>
    <div class="container">
        <!-- обертка для блога или новости -->
        <div class="more-block">
            <!-- оглавление -->
            <div class="more-head">
                <?
                if (isset($_SESSION['idBlog'])) {
                    echo $oneuser['Name'];
                ?>
                <!-- если это блог то появялется вот это блок аля должность -->
                    <div class="more-adhead">
                        <? echo $onerole['roleName']; ?>
                    </div>
                <?
                } else {
                    echo $onemore['headname'];
                }
                ?>
            </div>
            <!-- контент блога или новости -->
            <div class="more-text">
                <?
                if (isset($_SESSION['idBlog'])) {
                    echo $onemore['messages'];
                } else {
                    echo $onemore['message'];
                }
                ?>
            </div>
            <!-- дата -->
            <div class="more-date">
                <? echo $onemore['date'] ?>
            </div>
        </div>
        <? if (isset($_SESSION['role']) && $_SESSION['role'] == 'A') { ?>
            <div class="btn pointer" id="delbtn" type="<? if (isset($_SESSION['idBlog'])) {
                                                            echo "Blog";
                                                        } else {
                                                            echo "News";
                                                        } ?>" idBlogOrNews="<? echo $onemore['id'] ?>">
                <?
                if (isset($_SESSION['idBlog'])) {
                    echo "Удалить блог";
                } else {
                    echo "Удалить новость";
                }
                ?>
            </div>
        <? } ?>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#delbtn').on('click', function() {
            var btn = $(this);
            var id = btn.attr('idBlogOrNews');
            var type = btn.attr('type');
            $.ajax({
                url: "assets/php/delblogornews.php",
                type: "post",
                dataType: "json",
                data: {
                    "id": id,
                    "type": type,
                },
                success: function(data) {
                    if (data.result == "success") {
                        if (type == "Blog") {
                            $(location).attr('href', '/index.php');
                            alert("Блог удалён");
                        } else {
                            $(location).attr('href', '/index.php');
                            alert("Новость удалена");
                        }
                    } else {
                        alert("Ошибка");
                    }
                }
            });
        });
    </script>
</body>

</html>