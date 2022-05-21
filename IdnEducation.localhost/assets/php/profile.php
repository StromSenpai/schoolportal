<? session_start();
include 'connection.php';
?>
<!-- тоже самое просто не личная страница -->
<div class="kab-block">
    <div class="profile-kab">
        <div class="img-kab">
            <img src="/assets/images/<? echo $_SESSION['UserImg'] ?>" alt="аватарка" class="photo avatar">
        </div>
        <div class="name-profile">
            <?
            echo $_SESSION['UserName'];
            ?>
        </div>
        <div class="role-profile">
            <?
            $_SESSION['UserRole'];
            ?>
        </div>
    </div>
    <div class="actions">
        <div class="action">
             <?  
             $myuid = $_SESSION['UID'];
             $uid = $_SESSION['UIDUser']; 
             $myfriend = $mysqli->query("SELECT * FROM `chats` WHERE `IdHead` = $myuid AND `idAdd` = $uid OR `IdHead` = $uid AND `idAdd` = $myuid");
             $myfrienddata = array();
             while($result = $myfriend->fetch_array()){
                 $myfrienddata[] = $result;
             }
             $count = count($myfrienddata);
            if ($count == 0) { ?>
            <!-- для того чтобы начать чат с кем либо НУЖНО ЧТОБЫ ОНИ БЫЛИ ТАКОГО ВИДА ИНАЧЕ РАБОТАТЬ БУДЕТ ЧЕРЕЗ ЖОПУ (желательно удалить этот комментарий) -->
                <div class="btn pointer" id="startchat" onclick="StartChat(this)"  uid="<? echo $uid ?>">Начать чат</div>
            <? } else { ?>
                <div class="btn pointer" id="startchat" onclick="StartChat(this)" uid="<? echo $uid ?>">Написать</div>
            <? } ?>

        </div>
    </div>
</div>
<? if ($_SESSION['UserRoleid'] == 'A' || $_SESSION['UserRoleid'] == 'D' || strpbrk($_SESSION['UserRoleid'], "T")) {
    $myuid = $_SESSION['UIDUser'];
    $sql = $mysqli->query("SELECT * FROM `blog` WHERE `userid` = $myuid ORDER BY `date` DESC");
    $myblog = array();
    while ($result = $sql->fetch_array()) {
        $myblog[] = $result;
    }
    if (empty($myblog)) {
?> <div class="container">
    <!-- если записей нет -->
            <div class="head-parag">
                Нет записей
            </div>
        </div><?
            } else {
                ?>
        <div class="container">
            <!-- оглавление -->
            <div class="head-parag">
                БЛОГ
            </div>
            <!-- хз для чего это пускай будет -->
            <div class="myblog" id="blog-start">
                <?

                foreach ($myblog as $oneblog) {
                ?>
                <!-- вывод блогов самого пользователя -->
                    <div class="blog-profile">
                        <div class="headname">
                            <? echo $_SESSION['UserName'] ?>
                        </div>
                        <div class="text-profile">
                            <? echo $oneblog['messages'] ?>
                        </div>
                        <div class="date-profile">
                            <? echo $oneblog['date'] ?>
                        </div>
                    </div>
                <? } ?>
            </div>

        <? } ?>
        </div>

    <? } ?>