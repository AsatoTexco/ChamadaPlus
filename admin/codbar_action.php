<?php

session_start();
ob_start();
 require '../config.php';


    



if(!isset($_SESSION['adm_id']) && !isset($_SESSION['adm_nome'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: ../admin.php");
}else{

    $sql = $pdo->prepare("SELECT * FROM admin WHERE id = :id AND user = :user AND senha = :senha");
    $sql->bindValue(':id', $_SESSION['adm_id']);
    $sql->bindValue(':user', $_SESSION['adm_user']);
    $sql->bindValue(':senha', $_SESSION['adm_senha']);
    $sql->execute();

    // $lista = [];
    // $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

    if($sql->rowCount() == 0 ){

        $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";

    }


}

// _____________________________________SESSION___________________________________

$lista = [];
$id = filter_input(INPUT_POST, 'id'); 

// echo $data;

if(isset($id)){

    
    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    $lista = [];
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

    if($sql->rowCount() > 0 ){

        foreach($lista as $dados){
    
            $id = $dados['id'];
            $NChamada = $dados['NChamada'];
            $nome = $dados['nome'];
            $email = $dados['email'];
            $senha = $dados['senha'];
            $phone = $dados['phone'];
            $ano = $dados['ano'];
            $turma = $dados['turma'];
    
        }


    }else{
        $_SESSION['msg'] = "<p style='color: red;text-align: center;font-size: 20px' >Aluno não cadastrado";
        header("Location: codbar.php");
    }
    
    $dia = date('d-m-Y');
    // $dia = "04-01-2023";
        
    $sql = $pdo->prepare("SELECT * FROM presenca WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowCount() > 0 ){



        // PEGAR VALOR DE PRESENÇAS DO BANCO DE DADOS E CONCATENAR COM A NOVA PRESENÇA (IMPLODE) E DPS JOGAR DE VOLTA NO BANCO DE DADOS
        
        // $sql = $pdo->prepare("SELECT * FROM presenca WHERE id = :id");
        // $sql->bindValue(':id',$id);
        // $sql->execute();

        $presencas = [];
        $presencas = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($presencas as $presente){

            $data = $presente['presente'];

        }

            $data1 = ($data.",".$dia);


            // CONSULTAR O BANCO DE DADOS PARA VER SE TEM ALGUMA DATA IGUAL AO DIA ATUAL, SE TIVER CAI FORA, SENAO TIVER MANDA O CODIGO
            $sql = $pdo->prepare("SELECT * FROM presenca WHERE presente LIKE '%".$dia."%'");
            $sql->execute();

            if($sql->rowCount() > 0 ){

               
                $_SESSION['msg'] = "<p style='color: red;text-align: center;font-size: 20px' >Aluno ja presente";
                // $_SESSION['msg'] = "<p>Aluno ja presente>";
                header("Location: codbar.php");

            }else{


                // $sql = $pdo->prepare("INSERT INTO presenca (id,NChamada,nome,email,senha,phone,ano,turma, presente) VALUES (:id,:NChamada, :nome, :email, :senha, :phone, :ano, :turma, '$data1'); ");
                $sql = $pdo->prepare("UPDATE presenca SET presente = :presente WHERE id = :id"); 
                
                $sql->bindValue(':id', $id);
                // $sql->bindValue(':NChamada', $NChamada);
                // $sql->bindValue(':nome', $nome);
                // $sql->bindValue(':email', $email);
                // $sql->bindValue(':senha', $senha);
                // $sql->bindValue(':phone', $phone);
                // $sql->bindValue(':ano', $ano);
    
    
                $sql->bindValue(':presente', $data1);
                $sql->execute();
        
                $_SESSION['msg'] = "<p style='color: white;text-align: center;font-size: 20px' >Presença dada com sucesso";


                header("Location: codbar.php");

            }




            
        
       

    }else{



        // $sql = $pdo->prepare("INSERT INTO presenca VALUES :id, :NChamada, :nome, :email, :senha, :phone, :ano, :turma, :presente");
    
        $sql = $pdo->prepare("INSERT INTO presenca (id,NChamada,nome,email,senha,phone,ano,turma, presente) VALUES (:id,:NChamada, :nome, :email, :senha, :phone, :ano, :turma, :presente); ");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':NChamada', $NChamada);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':ano', $ano);
        $sql->bindValue(':turma', $turma);
        $sql->bindValue(':presente', $dia);
        $sql->execute();

        $_SESSION['msg'] = "<p style='color: white;text-align: center;font-size: 20px' >Presença dada com sucesso";


        header("Location: codbar.php");
    
    
    }

    
        
    

}


    

