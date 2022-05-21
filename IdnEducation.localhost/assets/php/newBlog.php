<?
// для кнопки показать больше
include 'connection.php';
$countIndex = $_POST['count_show'];
$countadd = $_POST['count_add'];
$sql = $mysqli->query("SELECT * FROM `blog` ORDER BY `date` DESC LIMIT $countIndex, $countadd");
$BlogsData = array();
while($result = $sql->fetch_array()){
    $BlogsData[] = $result;
}
 if (empty($BlogsData)) {
     echo json_encode(array(
         'result'    => 'finish',
     ));
 } else {
     $html = "";
     foreach($BlogsData as $oneblog){
         $id = $oneblog['id'];
         $UID = $oneblog['userid'];
         $user = $mysqli->query("SELECT * FROM `user` WHERE `UID` = '$UID'");
         $oneuser = $user->fetch_assoc();
         $roleid = $oneuser['role'];
         $role = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$roleid'");
         $onerole = $role->fetch_assoc();
         $message = $oneblog['messages'];
         if (mb_strlen($message) > 60){
             $message = mb_substr($message, 0 , 61, 'UTF-8') . "...";
         }
        //  меняй ток это только аккуратно это очень капризная вещь
         $html .= "<div class='blog-block pointer' idblog='{$id}' onclick='OpenBlog(this)'>
         <div class='blog-head'>
             <div class='blog-name'>
                 {$oneuser['Name']}
             </div>
             <div class='blog-role'>
                 {$onerole['roleName']}
             </div>
         </div>
         <div class='line-black'></div>
         <div class='blog-text'>
             {$message}
         </div>
     </div>";
     }
    //  если что это отправка назад с удачным исходом  
     echo json_encode(array(
        'result'    => 'success',
        'html'      =>  $html
    ));  
}
?>