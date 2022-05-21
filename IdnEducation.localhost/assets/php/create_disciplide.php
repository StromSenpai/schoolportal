<?
session_start();
include 'connection.php';
$namdiscip = $_POST['NamDiscip'];
$roles = $_POST['IdRoles'];
$discip = $mysqli->query("SELECT * FROM `discipline` WHERE `namediscip` = '$namdiscip'");
if(mysqli_num_rows($discip) > 0){
echo json_encode(array(
    'result' => 'error',
    'type' => 'thatdisciplinehas'
));
}else{
    if ($mysqli->query("INSERT INTO `discipline` (`namediscip`, `roles`) VALUES ('$namdiscip','$roles')")){
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
