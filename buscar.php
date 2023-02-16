<?php

session_start();
ob_start();
 require '../chamada/config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 13px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}

// ____________________________________SESSION________________________________


$turmaF = filter_input(INPUT_POST, 'turmaF');
$anoF = filter_input(INPUT_POST, 'anoF');
$nomeF = filter_input(INPUT_POST, 'nomeF');




if(!empty($anoF) or !empty($turmaF) or !empty($nomeF)){
    
    if(!empty($anoF) and !empty($turmaF) and !empty($nome)){

        $lista_alunos = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :ano AND turma = :turmaF AND nome LIKE '".$nomeF."%'");
        $sql->bindValue(':ano', $anoF);
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        echo "ano, nome e turma";


    }



    else if(!empty($nomeF) and !empty($turmaF)){

        $lista_alunos = [];
        
        
        // ====================================LIKE COM NOME DA VARIAVEL================================================

        // SELECT * FROM alunos WHERE turma = 'A' and nome like '%e%';
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE turma = :turmaF AND nome LIKE '".$nomeF."%'");
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        

    } else if(!empty($anoF) and !empty($nomeF)){
    
        $lista_alunos = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF and nome LIKE '".$nomeF."%'");
        $sql->bindValue(':anoF', $anoF);
        $sql->execute();
        

    } else if(!empty($anoF) and !empty($turmaF)){
    
        $lista_alunos = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF and turma = :turmaF");
        
        $sql->bindValue(':anoF', $anoF);
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        
    }
    

    else if(!empty($turmaF)){

        $lista_alunos = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE turma = :turmaF");
        $sql->bindValue(':turmaF', $turmaF);
        
        $sql->execute();
    
        
    }

    else if(!empty($nomeF)){

        $lista_alunos = [];
        
        // ====================================LIKE COM NOME DA VARIAVEL================================================


        $sql = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE '".$nomeF."%'");
        
        $sql->execute();

        
    }
       


       

        else if(!empty($anoF)){
        $lista_alunos = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF");
        $sql->bindValue(':anoF', $anoF);
        
        $sql->execute();
        
    }
    
    
    

    if($sql->rowCount() > 0 ){
    
        $lista_alunos = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }  
    

}else{


    $lista = [];
    $sql = $pdo->query("SELECT * FROM alunos");
    
    if($sql->rowCount() > 0 ){
    
        $lista_alunos = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }

}






?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Chamada/css/menu.css" media="screen" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
   
*{
    padding: 0;
    margin: 0;
}
body{
    background-image: linear-gradient(45deg,black,green,black);
}
h1{
    color: white;
}


    /* ======================================   Buscar alunos   ================================ */
    .input-ano,.input-turma{

width: 100px;
padding: 15px;
border-radius: 15px;


}

.input-nome{
padding: 15px;
width: auto;
border-radius: 15px;
}

.bot-sub{

margin-left: 10px;
padding: 15px;
width: 100px;
border: none;
border-radius: 15px;
color: white;
background-image: linear-gradient(45deg,green, black);
cursor: pointer;

}
.bot-sub:hover{
font-size: 20px;
transition: all ease-in-out 0.5s;
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
h1{
    text-align: center;
}



/* ======================================================================================== */

 
.conteiner{
        display: flex;
        justify-content: center;
        
        
    }
    .areaS{
        
        flex-direction: column;
        border-radius: 25px;
        justify-content: center;
        margin-top: 10px ;
        width: 60%;
        height: auto;
        background-color: rgb(219, 219, 219);
    }

    .areaS:first-child{

        padding-top: 25px;
    }



    

    .areaS:last-child{
        padding-bottom: 25px;
    }
    
.img_buscar_user{

height: 64px;
width: 64px;
object-fit: cover;
object-position: center;
border-radius: 100%;
padding: 10px;
position: relative ;
}
.aluno{
    display: flex;
    background-color: white;
    width: 600px;
    border-radius: 10px;
    height: 5%;
    margin-top: 10px;
    
    

}

.conteudo{

    display: flex;
    justify-content: center;


}
.about{
    display: flex;
    justify-content: center;
    flex-direction: column;
}

.geral{
    display: flex;
    justify-content: start;
    align-items: center;

    width: 70%;
    
}

.seg{

    display: flex;
    justify-content: center;
    align-items: center;

    width: 30%;

}
.seguir{
    background-color: green;
    color: white;
    text-decoration: none;
    padding: 10px;
    border-radius: 500px;
}
.unfollow{

    background-color: red;
    color: white;
    text-decoration: none;
    padding: 10px;
    border-radius: 500px;

}
.editar{

    background-color: blue;
    color: white;
    text-decoration: none;
    padding: 10px;
    border-radius: 500px;

}
a{
    text-decoration: none;
    color: black;
}

</style>
<link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="css/responsive_navbar.css" media="screen">
        



</head>
   
<body>

<!-- =================  menu  ========================== -->
<div class="areaMenu">

    <nav id="menu">

            
        <ul>
        
            <li><a href="menu.php">Home</a></li>

            <li><a href="lista_presenca.php">Minhas Presenças</a></li>

            <li><a href="sobre.php">Sobre</a></li>

            <!-- <li><a href="filtrar.php">Filtrar</a></li> -->

            <li><a href="perfil.php">Perfil</a></li>

            <li><a href="buscar.php">Buscar</a></li>
            
            <li class="entrar"><a href="sair.php">Sair</a></li> 
            
                            <!-- SAIR -->
        
        </ul>
    </nav>

</div>

<!-- ==========================  MENU RESPONSIVO  ======================== -->
<div class="overlay"id="nav">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="dados_perfil">


        <div class="img_area">
            <?php 

                $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
                $sql->bindValue(':id', $_SESSION['id']);
                $sql->execute();
                

                $dados_aluno_perfil = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($dados_aluno_perfil as $dados_aluno){

                    $nome_img = $dados_aluno['imagem'];
                    $nome = $dados_aluno['nome'];
                    $ano = $dados_aluno['ano'];
                    $turma = $dados_aluno['turma'];
                    $desc = $dados_aluno['descricao'];


                }





    
                if($nome_img != null){
    
                    echo("<a class'link_edit' href='edit_perfil.php?id=".$_SESSION['id']."'>
                                <img  src='imgsUser/".$_SESSION['id']."/ftPerfil/".$nome_img."' class='img_perfil'>
                            </a>");
                }else{
    
                    echo("<a class'link_edit' href='edit_perfil.php?id=".$_SESSION['id']."'>
                    <img  src='img/ft_nao_encontrada.png' class='img_perfil'>
                    </a>");
                    
                }
                ?>
    
                <a class="link_edit" href="edit_perfil.php?id=<?=$_SESSION['id']?>">
                    <p class='nome_perfil'><?=$nome?></p>
                </a>
           
        </div>
        




    </div>
    <div class="overlay-content" >

        <a href="menu.php">Menu</a>
        <a href="lista_presenca.php">Minhas Presenças</a>
        <a href="sobre.php">Sobre</a>
        <!-- <a href="filtrar.php">Filtrar</a> -->
        <a href="perfil.php">Perfil</a>
        <a href="buscar.php">Buscar</a>
        <a class="bot_sair" href="sair.php">Sair</a>


    </div>
</div>

<button class="nav-button" onclick="openNav()">
    <i class="fa-solid fa-bars fa-2x"></i>
</button>

<!-- =================  FIM menu  ========================== -->




<h1>Buscar Alunos</h1>
<br><br>

<form action="" method="POST"> 
    
    <label class="area-input-ano">
        
        Ano:   <input class="input-ano"type="number" max="4" min="1" name="anoF" placeholder="Ano">
        
        
    </label>
    
    <label class="area-input-turma">

        Turma:  <input class="input-turma"type="text" maxlength="1" minlength="1" name="turmaF" placeholder="Turma" >

    </label>


    <label class="area-input-nome">

        Nome:  <input class="input-nome"type="text" name="nomeF" placeholder="Insira o nome">

    </label>
    <input class="bot-sub"type="submit" value="Filtrar">

   



</form>



<div class="conteiner">                                                   
    <div class="areaS">
        <?php foreach($lista_alunos as $row_alunos):?>
        
        <div class="conteudo">
            <div class="aluno">
                <div class="geral">

                    <?php 
                    
                    if($row_alunos['imagem'] == null){

                        echo("<a href='perfil.php?id=".$row_alunos['id']."'><img class='img_buscar_user' src='img/ft_nao_encontrada.png'>");

                    }else{

                        echo("<a href='perfil.php?id=".$row_alunos['id']."'><img class='img_buscar_user' src='imgsUser/".$row_alunos['id']."/ftPerfil/".$row_alunos['imagem']."'>");

                    }
                    
                    ?>
                    
                    
                    </a>
                    <div class="about">
    
                        <a href="perfil.php?id=<?=$row_alunos['id']?>"><h3><?=$row_alunos['nome']?></h3>
                        <p><?=$row_alunos['ano']."°".$row_alunos['turma']?></p>
                        </a>
                        <!-- <h3>binca</h3>
                        <p>3A</p> -->
                    
                    </div>
                    
                </div>
                <div class="seg">

                    
                    <?php 

                        $id = $_SESSION['id'];

                        $sql = $pdo->prepare("SELECT seguindo FROM alunos WHERE id = :id AND seguindo LIKE '%".$row_alunos['id']."%'");
                        $sql->bindValue(':id', $id);
                        $sql->execute();

                        $seg = $sql->fetchAll(PDO::FETCH_ASSOC);
                        if($row_alunos['id'] == $_SESSION['id'] ){

                        //   ====================  MUDANÇA JA ======================
                            $id1 = $row_alunos['id'];
                            $f_or_u = "editar"; 
                            $link='edit_perfil';
                            
                        }
                        else if($sql->rowCount() == 0 ){

                            $id1 = $row_alunos['id'];
                            $f_or_u = "seguir"; 
                            $link='seguir';
                        
                                                               
                        }else{

                            $id1 = $row_alunos['id'];
                            $f_or_u = "unfollow"; 
                            $link='unfollow';

                        }


                    ?>

                    <a class="<?=$f_or_u?>" href="<?=$link?>.php?id=<?=$row_alunos['id'];?>"><?=$f_or_u?></a>
                </div>
                
            </div>
        </div>
        <?php endforeach ?>
        
    </body>
    </div>
</div>

<script type="text/javascript" src="menu_responsivo.js"></script>
</html>