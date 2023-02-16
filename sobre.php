<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id']) && !isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 13px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
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


.sobre{

    margin-left: 20%;
    margin-right: 20%;
    
}
h1{
    font-size: 40px;
    color: green;
}

.p_about{
    font-size: 25px;
}






</style>
<link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/responsive_navbar.css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        



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
    
                    echo("<a class'link_edit' href='perfil.php'>
                                <img  src='imgsUser/".$_SESSION['id']."/ftPerfil/".$nome_img."' class='img_perfil'>
                            </a>");
                }else{
    
                    echo("<a class'link_edit' href='perfil.php'>
                    <img  src='img/ft_nao_encontrada.png' class='img_perfil'>
                    </a>");
                    
                }
                ?>
    
                <a class="link_edit" href="perfil.php">
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



<div class="sobre">
    <h1>Sobre</h1>
    <p class="p_about">O primeiro protótipo desse site foi criado em 20/11/2022, com um objetivo de alcação centenas de jovens, nas quais se preocupam em se manter informados de novos eventos, programas, entre outros. Juntos acredito que no futuro podemos crescer esta plataforma de forma totalmente gratuita, conto com vocês. E se puderem compartilhem o link desse site com seus amigos e familiares :)</p>




</div>











<script type="text/javascript" src="menu_responsivo.js"></script>

</body>
</html>