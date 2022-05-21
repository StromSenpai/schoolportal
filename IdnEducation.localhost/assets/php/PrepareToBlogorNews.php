<?
// для того чтобы не пользоваться формами 
session_start();
if(isset($_POST['idNews'])){
    unset($_SESSION['idBlog']);
    $_SESSION['idNews'] = $_POST['idNews'];
}
if(isset($_POST['idBlog'])){
    unset($_SESSION['idNews']);
    $_SESSION['idBlog'] = $_POST['idBlog'];
}

?>