<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id']) && !isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 13px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}
//  ============================ SESSION =======================================
$NChamada = filter_input(INPUT_POST, 'NChamada');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$phone = filter_input(INPUT_POST, 'phone');
$ano = filter_input(INPUT_POST, 'ano');
$turma = filter_input(INPUT_POST, 'turma');

if($nome && $turma && $ano && $phone){

    


    $turma2 = 0 ;

    if ($turma == 'A'){

        $turma2 = 1   ;                 
    }if ($turma == 'B'){

        $turma2 = 2  ;                  
    }if ($turma == 'C'){

        $turma2 = 3 ;                   
    }if ($turma == 'D'){

        $turma2 = 4;                    
    }

    $idP = ($ano.$turma2.$NChamada);

    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id ");
    $sql->bindValue(':id', $idP);
    $sql->execute();

    
    if($sql->rowCount() == 0){
        
        $sql = $pdo->prepare("INSERT INTO alunos (id, NChamada,nome,email,senha, phone, ano, turma) VALUES (:id, :NChamada, :nome,:email, :senha, :phone, :ano, :turma)");
        $sql->bindValue(':id', $idP);
        $sql->bindValue(':NChamada', $NChamada);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':phone', $phone); 
        $sql->bindValue(':ano', $ano);
        $sql->bindValue(':turma', $turma);
        $sql->execute();
        
        
        header("Location: index.php");
        exit;
                
        
    }else{
        header("Location: cadastrar.php");
        $_SESSION['msg'] = "<p style='color: #ff0000'>ERRO: Usuário já cadastrado";
        
    }
        
}else{
        
    header("Location: cadastrar.php");
    exit;
        
}



