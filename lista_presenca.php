<?php

session_start();
ob_start();
 require '../chamada/config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 13px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}

// ____________________________________SESSION________________________________

$id = $_SESSION['id'];

// CONTADOR
$contF = 0;
$contP = 0;


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

<style>
        
    h1{
        color: white;
        text-align: center;
    }
    body{
            background-image: linear-gradient(45deg,black, green, black);

    }
    table{
        
        /* background-color: green; */
        text-align: center;
        border-color: green;
        font-size: 20px;
        background: white;
        border-radius: 15px;
        color: black;
        
        
     }
 
     table th,td{
         padding: 10px;
     }

     .tabelas{
        display: flex;
        justify-content: center;
        /* background-color: green; */
        

    }
    p{
        color: white;
        
    }.bot_sair{
    color: red;
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

    <h1>Presenças</h1>

    <br><br>

<div class="tabelas">




<table border="1">



    <tr>
    
        <th>ID</th>
        <th class="presenca_nome">Nome</th>
        <th>Dia</th>
        <th>Presente</th>
        
    

    </tr>

    <?php 
        $nome = $_SESSION['nome'];
        $letivos = ["01-01-2023","02-01-2023","03-01-2023","04-01-2023","05-01-2023","06-01-2023","07-01-2023","08-01-2023","09-01-2023","10-01-2023","11-01-2023","12-01-2023","13-01-2023","14-01-2023","15-01-2023","16-01-2023","17-01-2023","18-01-2023","19-01-2023","20-01-2023","21-01-2023","22-01-2023","23-01-2023","24-01-2023","25-01-2023","26-01-2023","27-01-2023","28-01-2023","29-01-2023","30-01-2023","31-01-2023"];
        
    foreach($letivos as $letivosD):?>
    <tr>
        <?php $dia = $letivosD;?>
        <td><?=$_SESSION['id']?></td>
        <td class="presenca_nome"><?=$_SESSION['nome']?></td>
        <td><?=$dia?></td>
        <td>

            <?php
            
                $sql = $pdo->prepare("SELECT * FROM presenca WHERE id = :id AND presente LIKE '%".$dia."%'");
                $sql->bindValue(':id',$id);
                $sql->execute();

                if($sql->rowCount() > 0 ){
                    echo'<p style="color: green; text-align: center; " >PRESENTE</p>';
                    $contP++;
                }else{
                    echo'<p style="color: red; text-align: center;">FALTO</p>';
                    $contF++;
                }
            ?>

        </td>

    </tr>
    <?php endforeach;?>


</table>






</div>

<p>

<?php 
    $totalAulas = $contF + $contP;

    $porcentP = ($contP * 100) / $totalAulas;
    $porcentP = number_format($porcentP, 2, '.', '');
    
    echo "Total de Aulas: ".$totalAulas;
    echo ("<br>Faltas: ".$contF."<br>Presenças: ".$contP);
    echo("<br>Porcentagem de Presença: ". $porcentP."%");
?>

</p>
<script type="text/javascript" src="menu_responsivo.js"></script>

</body>
</html>