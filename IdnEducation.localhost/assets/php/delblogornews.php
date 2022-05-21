<?php
// удаление блога или новости
include 'connection.php';
$id = $_POST['id'];
$type = $_POST['type'];
if ($type == "Blog"){
    if($mysqli->query("DELETE FROM `blog` WHERE `id` = '$id'")){
        echo json_encode(array(
            'result' => 'success'
        ));
    }
    else{
        echo json_encode(array(
            'result' => 'error'
        ));
    }

}else{
    if($mysqli->query("DELETE FROM `news` WHERE `id` = '$id'")){
        echo json_encode(array(
            'result' => 'success'
        ));
    }
    else{
        echo json_encode(array(
            'result' => 'error'
        ));
    }
}