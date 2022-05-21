<?
// для кнопки показать больше для новостей
include 'connection.php';
$countIndex = $_POST['count_show'];
$countadd = $_POST['count_add'];
$sql = $mysqli->query("SELECT * FROM `News` ORDER BY `date` DESC LIMIT $countIndex, $countadd");
$NewsData = array();
while($result = $sql->fetch_array()){
    $NewsData[] = $result;
}
 if (empty($NewsData)) {
     echo json_encode(array(
         'result'    => 'finish',
     ));
 } else {
     $html = "";
     foreach($NewsData as $onenews){
         $id = $oneblog['id'];
         $UID = $oneblog['UID'];
         $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$UID'");
         $oneuser = $user->fetch_assoc();
         $roleid = $oneuser['role'];
         $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$roleid'");
         $onerole = $role->fetch_assoc();
         $message = $onenews['message'];
         if (mb_strlen($message) > 60){
             $message = mb_substr($message, 0 , 61, 'UTF-8') . "...";
         }
        //  менять только тут, только аккуратно вещь капризная
         $html .= "<div class='news-block pointer' idNews='{$id}' onclick='OpenNews(this)'>
         <div class='news-head'>
         {$onenews['message']}
         </div>
         <div class='line-black'></div>
         <div class='news-text'>
             {$message}
         </div>
     </div>";
     }
    //  отправка назад с удачным исходом
     echo json_encode(array(
        'result'    => 'success',
        'html'      =>  $html
    ));  
}
