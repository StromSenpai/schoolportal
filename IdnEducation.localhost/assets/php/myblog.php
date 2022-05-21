<?
// блог на личной страничке
include 'connection.php';
session_start();
$myuid = $_SESSION['UID'];
$sql = $mysqli->query("SELECT * FROM `blog` WHERE `userid` = $myuid ORDER BY `date` DESC");
$myblog = array();
while ($result = $sql->fetch_array()) {
    $myblog[] = $result;
}
foreach ($myblog as $oneblog) {


?>
<!-- обертка блога -->
    <div class="blog-profile">
        <!-- фио -->
        <div class="headname">
            <? echo $_SESSION['Name'] ?>
        </div>
        <!-- контент блога -->
        <div class="text-profile">
            <? echo $oneblog['messages'] ?>
        </div>
        <!-- дата выкладывания -->
        <div class="date-profile">
            <? echo $oneblog['date'] ?>
        </div>
    </div>
<? } ?>
