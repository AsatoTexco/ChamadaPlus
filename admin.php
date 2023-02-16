<?php
session_start();
ob_start();
require 'config.php';

$user = filter_input(INPUT_POST, 'user');
$senha = filter_input(INPUT_POST, 'senha');

if($user && $senha){


    $sql = $pdo->prepare("SELECT * FROM admin WHERE user = :user AND senha = :senha");
    $sql->bindValue(':user',$user);
    $sql->bindValue(':senha',$senha);
    $sql->execute();



    if($sql->rowCount() > 0){
        $lista = [];
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($lista as $dados){


            $id = $dados['id'];
            $nome = $dados['nome'];
            $user = $dados['user'];
            $senha = $dados['senha'];


        }

        $_SESSION['adm_id'] = $id;
        $_SESSION['adm_nome'] = $nome;
        $_SESSION['adm_user'] = $user;
        $_SESSION['adm_senha'] = $senha;
        header("Location: admin/admin_menu.php");


    }else{
        $_SESSION['msg'] = "<p style='color: #ff0000;text-align:center;'>Senha Incorreta";
    }
    
    

}





?>







<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<style>

    body{
        background-image: linear-gradient(45deg, black,white,white,black);
    }

    form{
            background-color: rgb(0, 0, 0, 0.8);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: white;
            

    }

    .bot{

        width: 100%;
        cursor: pointer;
        padding: 10px;
        font-size: 15px;
        border-radius: 15px;
        border: none;

    }

    .bot:hover{

        background-color: black;
        color: white;
        transition: all 0.5s;


    }
    h1{
        text-align: center;
    }

    .texto{
        padding: 10px;
        border-radius: 10px;
        width: 90%;

    }



</style>
</head>
<body>

    <form method="POST" action="">

    <?php 
        if(isset($_SESSION['msg'])){

            echo $_SESSION['msg'];
            unset($_SESSION['msg']);

        }
    ?>
        
        <h1>Login</h1>

        Usuário:
        <br> 
        <input type="text" placeholder="Usuário" name="user" class="texto">
        
        <br><br>

        Senha:
        <br>
        <input type="password" placeholder="Senha" name="senha" class="texto">
        <br><br>
        <input type="submit" value="Entrar" class="bot">

    


</form>


</body>
</html>