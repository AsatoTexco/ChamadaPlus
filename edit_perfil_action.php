<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}

// ================================     SESSION      =========================================


$id = $_SESSION['id'];

// recebe valores do input 
$desc = filter_input(INPUT_POST,'descricao');

// procurando valor antigo
$sql = $pdo->prepare("SELECT imagem FROM alunos WHERE id = :id");
$sql->bindValue(':id',$id);
$sql->execute();
$local_img = $sql->fetchAll(PDO::FETCH_ASSOC);

// diretorio separdo pois o mkdir n estava funcionando tudo junto
$dir = 'imgsUser/'.$id.'/';
$dir1 = $dir.'ftPerfil/';

foreach($local_img as $local_img1){
    $local = $local_img1['imagem'];
}

// print("local: ".$local."<br>");

// diretorio completo
$diretorio = $dir1;


// variavel recebe o nome da imagem recebida
$img = $_FILES['imagem']['name'];
// echo("imagem: ".$img."<br>");


if(file_exists($dir) == false and file_exists($dir1) == true){
    mkdir($dir, 0755);
}elseif(file_exists($dir) == true and file_exists($dir1) == false){

    mkdir($dir1, 0755);
}elseif(file_exists($dir) == false and file_exists($dir1) == false){

    mkdir($dir, 0755);
    mkdir($dir1, 0755);
}




if($img != null){
    
    // comando apagar imagem anterior
    @unlink($dir1.$local);
    // echo("imagem setada");

    // faz upload da imagem no diretorio
    move_uploaded_file($_FILES['imagem']['tmp_name'],$dir1.$img);

    $sql = $pdo->prepare("UPDATE alunos SET imagem = :imagem WHERE id = :id");
    $sql->bindValue(':imagem',$img);
    $sql->bindValue(':id',$id);
    $sql->execute();

    
    
}


$sql = $pdo->prepare("UPDATE alunos SET descricao = :descricao WHERE id = :id");
$sql->bindValue(':descricao',$desc);
$sql->bindValue(':id',$id);
$sql->execute();


header("Location: perfil.php");




