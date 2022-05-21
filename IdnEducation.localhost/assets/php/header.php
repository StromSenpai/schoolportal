<? include 'connection.php';
session_start();
?>
<!-- сделал так чтобы не копировать его постоянно и так проще менять его -->
<div class="head">
    <div class="logo">
        <img src="/assets/images/logo.png" alt="логотип">
    </div>
    <div class="links">
        <div class="hrefs">
            <? if (isset($_SESSION['UID']) && $_SESSION['role'] == 'A') { ?>
                <a href="/admin.php" class="btn pointer">
                    Админка
                </a>
            <? } ?>
            <a href="/index.php">Главная</a>
            <a href="/lk.php">Личный кабинет</a>
            <a href="/messenger.php">Мессенджер</a>
            <a href="/users.php">Пользователи</a>
            <a href="/students.php">Обучение</a>
        </div>
        <div class="login">
            <? if (isset($_SESSION['UID'])) { ?>
                <div class="icolog">
                    <a href="/lk.php" class="name">
                        <img src="assets/images/<? echo $_SESSION['img'] ?>" alt="логин" class="photo avatar">
                    </a>
                </div>
                <div class="name">

                    <a href="/lk.php" id="name" class="name">
                        <? echo $_SESSION['Name'] ?>
                    </a>
                <? } else {

                ?>
                    <div class="icolog">
                        <a href="/login.php" id="name">
                            <img src="assets/images/icolog.png" alt="логин" class="photo avatar">
                        </a>
                    </div>
                    <div class="name">
                        <a href="/login.php" id="name" class="name">
                            Войти
                        </a>
                    <?
                } ?>
                    </div>
                </div>

        </div>
    </div>
</div>