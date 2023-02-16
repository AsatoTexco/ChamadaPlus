<?php

session_start();
ob_start();
 require '../config.php';

if(!isset($_SESSION['adm_id']) && !isset($_SESSION['adm_nome'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: ../admin.php");
}

// _____________________________________SESSION___________________________________

$id = filter_input(INPUT_GET, 'id');

if($id){

    $sql = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $sql-> bindValue(':id', $id);
    $sql->execute();

    header("Location: admin_menu.php");


}else{

    header("Location: admin_menu.php");
}