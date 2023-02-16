<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}
// =====================================    SESSION    ======================================

$id = filter_input(INPUT_GET,'id');
if($id != $_SESSION['id']){

    header("Location: menu.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />

    <style>
        
        form{
            margin-top: 10px;
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

background-color: green;
color: white;
transition: all 0.5s;




}
.imagem{
    border-radius: 5px;
}
h2{
    text-align: center;
}

.descricao{

    width: 100%;
    height: 80px;

}
textarea{
    resize: none;
    background-color: white;
    color: black;
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

    

<form action="edit_perfil_action.php" method="POST" enctype="multipart/form-data">
    
    <h2>Escolha uma foto top</h2>
    <input type="file" accept="image/*" name="imagem"  class="imagem"><br>

    <br>
    <textarea  type="text" wrap="hard" placeholder="Fale um pouco sobre você 😁" name="descricao" class="descricao"></textarea>  
    <br><br>
    <input type="submit" value="Editar" class="bot">








</form>


<script type="text/javascript" src="menu_responsivo.js"></script>
</body>
</html>