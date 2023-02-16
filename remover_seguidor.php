<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
    
}

// ======================================== SESSION =============================================

// id do usuario que irá remover
$id_remover =  filter_input(INPUT_GET,'id');


// REMOVER SEGUIDOR QUANDO A TABELA SEGUINDO POSSUIR MEU ID(REMOVERA MEU ID DA TABELA SEGUINDO DELE)


// consulta ao banco de dados para os valores da tabela seguindo do usuario que ira remover
$sql = $pdo->prepare("SELECT * FROM alunos WHERE id =  :id");
$sql->bindValue(':id',$id_remover);
$sql->execute();

// variavel recebe o valor da consulta 
$seguidor_remover = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach($seguidor_remover as $sr){
    // variavel recebe valor da coluna "seguindo" do banco de dados 
    $seguindo = $sr['seguindo'];

}



// SE SEGUINDO POSSUIR O MEU ID REMOVE E DA UPDATE PARA A MESMA TABELA DO BANCO DE DADOS 

// transformando string do banco de dados em array para mais facil manipulação 
$array_seg = explode(',',$seguindo);

// criando array nova 
$arrayS = [];

// foreach para percorrer todo a array 
foreach($array_seg as $seguidoress){

    // se tiver o item da array for diferente do session['id'] ele adiciona a array recem criada     
    if($seguidoress != $_SESSION['id']){

        array_push($arrayS,$seguidoress);

    }

    
}

// retorna a array para uma string, separando cada item por ","
$seguindo_string = implode(",", $arrayS);



$sql = $pdo->prepare("UPDATE alunos SET seguindo = :seguindo WHERE id = :id");
$sql->bindValue(':seguindo', $seguindo_string);
$sql->bindValue(':id', $id_remover);
$sql->execute();

$_SESSION['action_js'] = "<input type='hidden' value='1' id='teste'>";
header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));



?>