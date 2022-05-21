<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include 'assets/php/connectassets.php' ?>
    <title>Главная</title>
</head>

<body>

    <!-----тут все что ты делал думаю ты помнишь------>
    <div class="mainheader">
        <div class="header-color">
            <div class="header-text">
                <div class="title">
                    Школьный портал
                </div>
                <div class="line-white" style="width: 4%; margin: 2% 48%;">

                </div>
                <div class="paragraph">
                    Учись и развивайся!
                </div>
            </div>
        </div>
    </div>
    <!----------->
    <? include 'assets/php/header.php' ?>
    <!----------->
    <div class="main">
        <div class="portfolio">
            <div class="AboutUsText">
                <div class="title">
                    О НАС
                </div>
                <div class="line-black" style="width: 4%; margin: 1% 48%;">

                </div>
                <div class="paragraph">
                    Что это за сайт
                </div>
                <div class="text">
                    Мы школьный портал. Который позволяет следить за своей успеваемостью общаться с участниками и учителями и следить за жизнью школы
                </div>
            </div>
        </div>
        <!----------->
        <div class="head-parag">
            НОВОСТИ
        </div>
        <div class="news" id="news-start">
            <? include 'assets/php/news.php' ?>
        </div>
        <div class="action">
            <input type="button" value="Показать больше" id="Newsadd" type="News" class="btn pointer" count_show="5" count_add="5">
        </div>
        <!----------->
        <div class="head-parag">
            БЛОГ
        </div>
        <div class="blog" id="blog-start">
            <? include 'assets/php/blog.php' ?>
        </div>
        <div class="action">
            <input type="button" value="Показать больше" id="Blogadd" count_show="5" count_add="5" class="btn pointer">
        </div>
        <!----------->
        <div class="contact-form">
            <div class="contact-form-text">
                <!-- шрифт Comfortaa не именно тут ставь типографика первых двух букв плохая -->
                <div class="title">
                    Связаться с нами
                </div>
            </div>
            <div class="form">
                <div class="contacts">
                    <input type="text" placeholder="Имя">
                    <input type="text" placeholder="Почта">
                </div>
                <div class="message">
                    <textarea name="message" id="message" cols="40" rows="10" placeholder="Cообщение" autocomplete="off"></textarea>
                </div>
            </div>
            <a href="#">
                Отправить
            </a>
        </div>
    </div>

    <div class="footer">
        <a href="#">ссылка</a>
        <a href="#">ссылка</a>
        <a href="#">ссылка</a>
        <a href="#">ссылка</a>
        <a href="#">ссылка</a>
    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // кнопка показать больше у блога
            $('#Blogadd').click(function() {
                var btn_more = $(this);
                var count_show = parseInt($(this).attr('count_show'));
                var count_add = $(this).attr('count_add');
                btn_more.val('Подождите...');
                $.ajax({
                    url: "assets/php/newBlog.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        "count_show": count_show,
                        "count_add": count_add,
                    },
                    success: function(data) {
                        if (data.result == "success") {
                            $('#blog-start').append(data.html);
                            btn_more.val('Показать еще');
                            btn_more.attr('count_show', (count_show + 5));
                        } else {
                            btn_more.val('Больше нечего показывать')
                        }
                    }
                });
            });
            // кнопка показать больше у новостей
            $('#Newsadd').click(function() {
                var btn_more = $(this);
                var count_show = parseInt($(this).attr('count_show'));
                var count_add = $(this).attr('count_add');
                btn_more.val('Подождите...');
                $.ajax({
                    url: "assets/php/newNews.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        "count_show": count_show,
                        "count_add": count_add,
                    },
                    success: function(data) {
                        if (data.result == "success") {
                            $('#blog-start').append(data.html);
                            btn_more.val('Показать еще');
                            btn_more.attr('count_show', (count_show + 5));
                        } else {
                            btn_more.val('Больше нечего показывать')
                        }
                    }
                });
            });
        });

// полное открытие блога на другой странице
        function OpenBlog(i) {
            var idblog = $(i).attr('idblog');
            $.post("assets/php/PrepareToBlogorNews.php", {
                    idBlog: idblog
                },
                function() {
                    $(location).attr('href', '/more.php?' + idblog);
                });
        }
// полное открытие новости на другой странице
        function OpenNews(i) {
            var idnews = $(i).attr('idNews');
            $.post("assets/php/PrepareToBlogorNews.php", {
                    idNews: idnews
                },
                function() {
                    $(location).attr('href', '/more.php?' + idnews);
                });
        }
    </script>
</body>

</html>