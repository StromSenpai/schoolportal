<?
session_start();
include 'connection.php';
$idstud = $_POST['IdStud'];
$class = $_POST['Class'];
$classes = $mysqli->query("SELECT * FROM `classes` WHERE `UIDStud` = '$idstud'");
if(mysqli_num_rows($classes) == 1){
    $oneclass = $classes->fetch_assoc();
    $id = $oneclass['id'];
    if($mysqli->query("UPDATE `classes` SET `class`='$class' WHERE `id` = '$id'")){
        echo json_encode(array(
            'result' => 'success',
            'type' => 'update'
        ));
    }else{
        echo json_encode(array(
            'result' => 'error',
            'type' => 'update'
        ));
    }
}else{
    if($mysqli->query("INSERT INTO `classes`(`UIDStud`, `class`) VALUES ('$idstud', '$class')")){
       
        echo json_encode(array(
            'result' => 'success',
            'type' => 'add'
        ));
    }else{
        echo json_encode(array(
            'result' => 'error',
           'type' => 'add'
        ));
    }
}
?>