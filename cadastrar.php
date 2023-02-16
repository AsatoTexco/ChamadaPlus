<?php
session_start();
ob_start();
 require 'config.php'
?>


<!DOCTYPE html>
<html lang="en">
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
            top: 66%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 100px;
            border-radius: 15px;
            color: white;


        }  

        .texto{

            width: 100%;
            padding: 10px;
            border-radius: 15px;
            outline: none;
            font-size: 15px;
            border: none;

        }

        .entrar{

            border: none;
            height: 50px;
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
        h2{
            margin: 0;
            text-align: center;
        }
       
        .radio{
            
            
            justify-content: center;
        }

        .radios{
            
            text-align: center;
            justify-content: center;
        }

        

        

    </style>


</head>
<body>

      

<form class="login" action="cadastrar_action.php" method="POST">

    
    <h1>Cadastrar</h1>
    <?php
    if(isset($_SESSION['msg'])){

        echo($_SESSION['msg']);
        unset($_SESSION['ms']);
    }
       
    ?>
    <br><br>

    <input name="nome" type="text" class="texto" placeholder="Nome">
    <br><br>
    
    <input name="email" type="email" class="texto" placeholder="E-mail">
    <br><br>

    <input name="senha" type="password" maxlength="25" class="texto" placeholder="Senha">
    
    <br><br>

    <input name="NChamada" type="text" class="texto" placeholder="Número da chamada" maxlength="2" minlength="2">
    <br><br>

    <input name="phone" type="number" class="texto" placeholder="Celular">
    <br><br>

    <h2>Ano</h2>
    <br>
    <div class="radios">

        <label for="ano">1°</label>
        <input type="radio" value="1" name="ano">
        
        <label for="ano">2°</label>
        <input type="radio" value="2" name="ano">
        
        <label for="ano">3°</label>
        <input type="radio" value="3" name="ano">


    </div>
        <br><br>

    <h2>Turma</h2>
    <br>

    <div class="radios">
    <label for="ano">A</label>
    <input class="radio" type="radio" value="A" name="turma">
    
    <label for="ano">B</label>
    <input class="radio" type="radio" value="B" name="turma">
    
    <label for="ano">C</label>
    <input class="radio" type="radio" value="C" name="turma">
    
    <label for="ano">D</label>
    <input class="radio" type="radio" value="D" name="turma">
    
    </div>
    <br><br>


    <input type="submit" class="entrar" value="Criar">
    <br>
    <br>
    <!-- <a href="#">Esqueci a senha</a> -->
    
    <a href="index.php">Entrar</a>
    
</form>

</body>
</html>