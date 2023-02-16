<?php

session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}

// _____________________________________SESSION___________________________________

$lista = [];
$sql = $pdo->query("SELECT * FROM alunos");

if($sql->rowCount() > 0 ){

    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

}

?>

<header>
    <style>

    table{
        
        margin-left: auto;
        margin-right: auto;


    }

    h1{
        text-align: center;
    }
    table tr th{
        word-wrap: break-word;
    }

    </style>
</header>
<a href="codbar.php">Chamada PLUS</a>
<a href="consulta.php">Consultar</a>
<a href="cadastrarv2.php"> Cadastrar Alunos</a>

<title>Listagem de Alunos</title>
<h1>Listagem de Alunos</h1>

<table border="1">

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

            <a href="editar.php?id=<?=$dadosAluno['id'];?>">[ Editar ]</a>
            <a href="excluir.php?id=<?=$dadosAluno['id'];?>">[ Excluir ]<a>

        </td>

    </tr> 
    
    <?php endforeach; ?>

</table>

