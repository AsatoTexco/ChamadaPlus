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

$turmaF = filter_input(INPUT_POST, 'turmaF');
$anoF = filter_input(INPUT_POST, 'anoF');
$nomeF = filter_input(INPUT_POST, 'nomeF');




if(!empty($anoF) or !empty($turmaF) or !empty($nomeF)){
    
    if(!empty($anoF) and !empty($turmaF) and !empty($nome)){

        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :ano AND turma = :turmaF AND nome LIKE '%".$nomeF."%'");
        $sql->bindValue(':ano', $anoF);
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        echo "ano, nome e turma";


    }



    else if(!empty($nomeF) and !empty($turmaF)){

        $lista = [];
        
        
        // ====================================LIKE COM NOME DA VARIAVEL================================================

        // SELECT * FROM alunos WHERE turma = 'A' and nome like '%e%';
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE turma = :turmaF AND nome LIKE '%".$nomeF."%'");
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        

    } else if(!empty($anoF) and !empty($nomeF)){
    
        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF and nome LIKE '%".$nomeF."%'");
        $sql->bindValue(':anoF', $anoF);
        $sql->execute();
        

    } else if(!empty($anoF) and !empty($turmaF)){
    
        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF and turma = :turmaF");
        
        $sql->bindValue(':anoF', $anoF);
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        
    }
    

    else if(!empty($turmaF)){

        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE turma = :turmaF");
        $sql->bindValue(':turmaF', $turmaF);
        
        $sql->execute();
    
        
    }

    else if(!empty($nomeF)){

        $lista = [];
        
        // ====================================LIKE COM NOME DA VARIAVEL================================================


        $sql = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE '%".$nomeF."%'");
        
        $sql->execute();

        
    }
       


       

        else if(!empty($anoF)){
        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF");
        $sql->bindValue(':anoF', $anoF);
        
        $sql->execute();
        
    }
    
    
    

    if($sql->rowCount() > 0 ){
    
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

    
    }  
    

}else{


    $lista = [];
    $sql = $pdo->query("SELECT * FROM alunos");
    
    if($sql->rowCount() > 0 ){
    
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }

}

?>

<head>
<style>
    
    html{

        background-image: linear-gradient(45deg,white,black, black, white);

    }

    h1{
        text-align: center;
        color: white;
    }

    table{
        
        /* background-color: green; */
        text-align: center;
        border-color: black;
        font-size: 20px;
        background: white;
        border-radius: 15px;
        color: black;
        
        
        
     }
 
     table th,td{
         padding: 5px;
     }

     .tabelas{
        display: flex;
        justify-content: center;
        /* background-color: green; */
        

    }
    .acoes{
        color: black;
        /* text-decoration: none; */
    }
    a{
        color: white;
    }
    form{

        display: flex;
        justify-content: center;

    }
    label{
        margin-left: 10px;
        color: white;
        font: 20px;
    }

    .bot-sub{

        margin-left: 10px;
        padding: 15px;
        width: 100px;
        border: none;
        border-radius: 15px;
        color: black;
        font-size: 15px;
        background-color: white;
        cursor: pointer;

    }
    .bot-sub:hover{
        background-color: green;
        color: white;
        transition: all ease-in-out 0.5s;
    }
    .input{

        width: 100px;
        padding: 15px;
        border-radius: 15px;


    }

    .input-nome{
        padding: 15px;
        width: auto;
        border-radius: 15px;
    }
    a{
        color: black;
    }
    .edit:hover{
        color: blue;
    }
    .excluir:hover{
        color: red;
    }

</style>
</head>
<link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
<div class="areaMenu">

    <nav id="menu">

            
        <ul>
        
            <li><a href="admin_menu.php">Editar Alunos</a></li>

            

            <li><a href="codbar.php">Leitor Código de barras</a></li>
            
            <li class="entrar"><a href="sair.php">Sair</a></li> 
            
                            <!-- SAIR -->
        
        </ul>
    </nav>

</div>

<title>Listagem de Alunos</title>
<h1>Listagem de Alunos</h1>

<form action="" method="POST"> 
    
    <label>
        
        Ano:   <input class="input"type="number" max="4" min="1" name="anoF" placeholder="Ano">
        
        
    </label>
    
    <label>

        Turma:  <input class="input"type="text" maxlength="1" minlength="1" name="turmaF" placeholder="Turma" >

    </label>


    <label>

        Nome:  <input class="input-nome"type="text" name="nomeF" placeholder="Insira o seu Nome">

    </label>
    <input class="bot-sub"type="submit" value="Filtrar">

   



</form>

<div class="tabelas">


<table border="3    " >

    <tr>

        <th>ID</th>
        <th>Número da Chamada</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Senha</th>
        <th>Telefone</th>
        <th>Série</th>
        <th>Ações</th>

    </tr>
    <?php foreach($lista as $dadosAluno):?>

    <tr>

        <td><?=$dadosAluno['id']?></td>
        <td><?=$dadosAluno['NChamada']?></td>
        <td><?=$dadosAluno['nome']?></td>
        <td><?=$dadosAluno['email']?></td>
        <td><?=$dadosAluno['senha']?></td>
        <td><?=$dadosAluno['phone']?></td>
        <td><?=$dadosAluno['ano'].$dadosAluno['turma']?></td>
        
        <td>

            <a class="edit" href="editar.php?id=<?=$dadosAluno['id'];?>" class="acoes">Editar</a>
            <a class="excluir" href="excluir.php?id=<?=$dadosAluno['id'];?>"class="acoes">Excluir<a>

        </td>

    </tr> 
    
    <?php endforeach; ?>

</table>


</div>


