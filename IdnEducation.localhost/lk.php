<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php'; ?>
    <title>
        <?php
        session_start();
        echo $_SESSION['Name'];
        ?>
    </title>
</head>

<body>
    <? include 'assets/php/header.php'; ?>
    <div class="container">
        <? include 'assets/php/kabinet.php'; ?>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // обратка нажатия на выход
            $('#exitbtn').on('click', function() {
                $.post("assets/php/exit.php", function(){
                $(location).attr('href', '/index.php');
                });
            });
        });
    </script>
</body>

</html>