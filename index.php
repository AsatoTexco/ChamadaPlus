<?php
session_start();
ob_start();
 require 'config.php'
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>

        body{

            background: linear-gradient(45deg, black,green, black);
            background-size: 300% ;
            animation: colors ease 10s infinite;
            

        }

            @keyframes colors{

                0%{
                    background-position: 0% 50%;
                }
                50%{
                    background-position: 100% 50%;
                }
                100%{
                    background-position: 0% 50%;
                }

        }
        h1{
            text-align: center;
           
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

        .texto{

            padding: 10px;
            outline: none;
            font-size: 15px;
            border: none;

        }

        .entrar{

            border: none;
            width: 100%;
            border-radius: 15px;
            background-color: green;
            padding: 10px;
            font-size: 15px;
            color:white;
            

        }


        .entrar:hover{

            background-color: greenyellow;
            cursor: pointer;
        }

        a{

            
            color: white;
            
        

        }
       


    </style>


</head>
<body>

     
    
<form class="login" action="" method="POST">

<?php

    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');

    if($email && $senha){

        $sql = $pdo->prepare("SELECT * FROM alunos WHERE email = :email AND senha = :senha");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();


        if($sql-> rowCount() > 0){
            $lista = [];
            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            
            foreach($lista as $emailsenha){
                
                if(strcasecmp($email, $emailsenha['email']) == 0 && strcasecmp($senha, $emailsenha['senha']) == 0 ){
                    

                    $_SESSION['id'] = $emailsenha['id'];
                    $_SESSION['nome'] = $emailsenha['nome'];
                    // echo "<p style='color: #00ff00'>Macaco logado com Sucesso";
                    header('Location: menu.php');
                }

            }


        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>ERRO: Usuário ou senha inválidos";
        }

    }

    if(isset($_SESSION['msg'])){
        echo($_SESSION['msg']);
        unset($_SESSION['msg']);
    }

    ?>      
    



    <h1>Login</h1>
    <br><br>
    <input name="email" type="email" class="texto" placeholder="E-mail">
    
    <br><br>

    <input name="senha" type="password" class="texto" placeholder="Senha">
    <br><br>

    <input type="submit" class="entrar" value="Entrar">
    
    <!-- <a href="#">Esqueci a senha</a> -->
    <br>
    <a href="cadastrar.php">Cadastrar</a>
    
</form>
    
</body>
</html>