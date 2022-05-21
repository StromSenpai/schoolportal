<?
session_start();
include 'connection.php';
$idrole = $_POST['IdRole'];
$namrole = $_POST['NamRole'];
$roles = $mysqli->query("SELECT * FROM `roles` WHERE `roleid` = '$idrole'");
if (mysqli_num_rows($roles) > 0) {
    echo json_encode(array(
        'result' => 'error',
        'type' => 'thathasrole'
    ));
} else {
    if($mysqli->query("INSERT INTO `roles`(`roleid`, `roleName`) VALUES ('$idrole','$namrole')")){
        echo json_encode(array(
            'result' => 'success'
        ));
    }else{
        echo json_encode(array(
            'result' => 'error',
            'type' => 'server'
        ));
    }
}
