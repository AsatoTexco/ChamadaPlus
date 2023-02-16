<?php
session_start();
ob_start();
 require '../config.php';

if(!isset($_SESSION['adm_id']) && !isset($_SESSION['adm_nome'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 13px'  >Necessário entrar em sua conta primeiro";
    header("Location: ../admin.php");
}

// _____________________________________________SESSION____________________________________
//
$id = filter_input(INPUT_POST,'id');
$NChamada = filter_input(INPUT_POST,'NChamada');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$phone = filter_input(INPUT_POST, 'phone');
$ano = filter_input(INPUT_POST, 'ano'); 
$turma = filter_input(INPUT_POST, 'turma'); 



if($id && $NChamada && $nome && $email && $senha && $phone && $ano && $turma){

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

    
    $id1 = ($ano.$turma2.$NChamada);

    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id1");
    $sql->bindValue(':id1',$id1);
    $sql->execute();

    if($sql->rowCount() == 0){



        $sql = $pdo->prepare("UPDATE alunos SET id = :id1, NChamada = :NChamada, nome = :nome, email = :email, senha = :senha,  phone = :phone, ano = :ano, turma = :turma WHERE id = :id");
        $sql->bindValue(':id1', $id1);
        $sql->bindValue(':NChamada',$NChamada);
        $sql-> bindValue(':nome', $nome);
        $sql-> bindValue(':email', $email);
        $sql-> bindValue(':senha', $senha);
        $sql-> bindValue(':phone', $phone);
        $sql-> bindValue(':ano', $ano);
        $sql-> bindValue(':turma', $turma);
        $sql->bindValue(':id',$id);
        $sql->execute();
        
        $sql = $pdo->prepare("UPDATE presenca SET id = :id1, NChamada = :NChamada, nome = :nome, email = :email, senha = :senha,  phone = :phone, ano = :ano, turma = :turma WHERE id = :id");
        $sql->bindValue(':id1', $id1);
        $sql->bindValue(':NChamada',$NChamada);
        $sql-> bindValue(':nome', $nome);
        $sql-> bindValue(':email', $email);
        $sql-> bindValue(':senha', $senha);
        $sql-> bindValue(':phone', $phone);
        $sql-> bindValue(':ano', $ano);
        $sql-> bindValue(':turma', $turma);
        $sql->bindValue(':id',$id);
        $sql->execute();
        if($_SESSION['id'] == $id){
            unset($_SESSION['id']);
        }
        header("Location: admin_menu.php");

    }else{
        // se o id for igual ao que esta editando, edita, mas com exceção do ano turma e numero Chamada
        if($id == $id1){

            $sql = $pdo->prepare("UPDATE alunos SET id = :id1, NChamada = :NChamada, nome = :nome, email = :email, senha = :senha,  phone = :phone, ano = :ano, turma = :turma WHERE id = :id");
            $sql->bindValue(':id1', $id1);
            $sql->bindValue(':NChamada',$NChamada);
            $sql-> bindValue(':nome', $nome);
            $sql-> bindValue(':email', $email);
            $sql-> bindValue(':senha', $senha);
            $sql-> bindValue(':phone', $phone);
            $sql-> bindValue(':ano', $ano);
            $sql-> bindValue(':turma', $turma);
            $sql->bindValue(':id',$id);
            $sql->execute();
        
            $sql = $pdo->prepare("UPDATE presenca SET id = :id1, NChamada = :NChamada, nome = :nome, email = :email, senha = :senha,  phone = :phone, ano = :ano, turma = :turma WHERE id = :id");
            $sql->bindValue(':id1', $id1);
            $sql->bindValue(':NChamada',$NChamada);
            $sql-> bindValue(':nome', $nome);
            $sql-> bindValue(':email', $email);
            $sql-> bindValue(':senha', $senha);
            $sql-> bindValue(':phone', $phone);
            $sql-> bindValue(':ano', $ano);
            $sql-> bindValue(':turma', $turma);
            $sql->bindValue(':id',$id);
            $sql->execute();
            if($_SESSION['id'] == $id){
                unset($_SESSION['id']);
            }
            header("Location: admin_menu.php");

        }else{

            $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Ja existe um aluno com o mesmo numero de chamada, ano e turma";
            header("Location: editar.php?id=".$id);
        }

    }
    

    


}else{

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Preencha todos os valores primeiro";
    header("Location: editar.php?id=".$id);

    
}

