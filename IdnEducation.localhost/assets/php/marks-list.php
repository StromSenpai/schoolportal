<?
session_start();
include 'connection.php';
?>
<!-- контейнер -->
<div class="container">
    <? if ($_SESSION['role'] == 'A' || $_SESSION['role'] == 'D' || strpbrk($_SESSION['role'], 'T')) { ?>
        <!-- блок справа чтобы ставить или удалять оценки -->
        <div class="sendmarks">
            <div class="head-text">
                Действия
            </div>
            <input type="button" value="Поставить оценку" class="btn pointer" onclick="setmark(this)" iddiscipline="<?echo $_SESSION['UIDDiscip']?>"  id="setmark">
            <input type="button" value="Удалить" class="btn pointer" onclick="del()" id="delbtn">
        </div>
    <? } ?>
    <!-- список с оценками -->
    <div class="block-marks">
        <!-- нзавание предмета -->
        <div class="namediscip">
            <? echo $_SESSION['NameDiscip'] ?>
        </div>
        <?
        $iddiscip = $_SESSION['UIDDiscip'];
        $uidstud = $_SESSION['UIDStud'];
        $marks = $mysqli->query("SELECT * FROM `marks` WHERE `idDIscip` = '$iddiscip' AND `idStud` = '$uidstud' ORDER BY `date` DESC");
        $allmarks = array();
        $count = 0;
        $average = 0;
        while ($result = $marks->fetch_array()) {
            $allmarks[] = $result;
        }
        foreach ($allmarks as $onemark) {
            $count += 1;
            $average += $onemark['mark'];
        }
        if($count == 0){
            //    если оценок нет
            ?><div class="avgmark"><? echo "Оценок нет" ?></div><?
        }else{
        $avg = $average / $count;
        ?>
        <!-- блок с средним баллом -->
        <div class="avgmark"><? echo "Средний балл: " . round($avg, 2, PHP_ROUND_HALF_UP); ?></div>
        <?}?>
        
        <!-- пометка для списка -->
        <div class="block-mark">
            <div>
                Оценка:
            </div>
            <div>
                Время:
            </div>
        </div>
        <?
        foreach ($allmarks as $onemark) {

        ?>
        <!-- вывод списка -->
            <div class="block-mark pointer" onclick="check(this)" idmark="<? echo $onemark['id'] ?>">
                <div class="mark 
            <?
            if ($onemark['mark'] > 3) {
                echo "goodmark";
            }
            if ($onemark['mark'] == 3) {
                echo "midmark";
            }
            if ($onemark['mark'] < 3) {
                echo "badmark";
            }
            ?>
            ">
                    <? echo $onemark['mark']; ?>
                </div>
                <!-- дата -->
                <div class="date">
                    <?
                    echo $onemark['date'];
                    ?>
                </div>
            </div>
        <?
        }
        ?>


    </div>

</div>