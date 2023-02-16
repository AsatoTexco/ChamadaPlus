<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
    
}

// ======================================== SESSION =============================================
    
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


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        
        <title>Menu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
                <!-- MENU CSS -->


<style>

html{
    min-width: 300px;
}

body{

background-image: linear-gradient(45deg, black,green,black);


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

.bemvindo1{
    color: white;
text-align: center;
font-size: 20px;

}
.bemvindo{

    color: white;
    font-size: 50px;
    text-align: center;
    margin-top: 20%;
    left: 50%;

}

.sair{

    padding: 15px;
    background-color: green;
    color: white;
    text-decoration: none;
    border-radius: 15px;
    

}


.conteiner1{

    margin-top: 400px;
    position: sticky;
    background: linear-gradient(-45deg, black,green,black);
    
    
    background-size: 300% 300% ;
    animation: colors ease 10s infinite;


    top: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    
    color: white;
    

}

.conteiner2{
    
    
    position: sticky;
    background: linear-gradient(-45deg,#F2A057,#F22987,#F24B6A,#6941BF ,#6941BF);
    background-size: 300% 300% ;
    animation: colors ease 5s infinite;
    top: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    
    color: white;


}

.conteiner3{
    
    
    position: sticky;
    background-image: linear-gradient(-45deg,#05C7F2 ,#03A64A,#F2E313);

    background-size: 300% 300% ;
    animation: colors ease 10s infinite;

    top: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    background-color: black;
    color: white;


}

/* .container4{
    position: sticky;
    background-image: linear-gradient(180deg,black, grey);
top: 0;
width: 100%;
height: 100%;
display: flex;
background-color: black;


}

.container5{
    position: sticky;
    background-image: linear-gradient(180deg,grey, cyan);
top: 0;
width: 100%;
height: 100%;
display: flex;
background-color: grey;


}


.container6{
    position: sticky;
    background-image: linear-gradient(180deg,cyan, blue);
top: 0;
width: 100%;
height: 100%;
display: flex;
background-color: cyan;


}


.container7{
position: sticky;
top: 0;
width: 100%;
height: 100%;
display: flex;
background-color: blue;


} */


.info h1{

text-align: center;


}

.info p{

text-align: center;

}

.link1{
    padding: 20px;
    text-decoration: none;
    background-color: green;
    color: white;
    border-radius:15px ;

    display: flex;
    margin: 0 auto;
    width: 200px;
    text-align: center;
    justify-content: center;
}

.link2{
    padding: 20px;
    text-decoration: none;
    background-color: #6941BF;
    color: white;
    border-radius:15px ;

    display: flex;
    margin: 0 auto;
    width: 200px;
    text-align: center;
    justify-content: center;
}

.link3{
    padding: 20px;
    text-decoration: none;
    background-color: #05C7F2;
    color: white;
    border-radius:15px ;

    display: flex;
    margin: 0 auto;
    width: 200px;
    text-align: center;
    justify-content: center;
}

    .link1:hover,.link2:hover,.link3:hover{

        background-color: white;
        
        color: black;
        transition: all ease-in-out 0.5s;
        

    }

.area-info{
    padding: 50px;
    display: flex;
    align-items:center;
    
}



.img-info{
    
    max-height: 450px;
    max-width: 450px;
    display: flex;
    

}
.content-conteiner{

display: flex;


}



/* _____________________________________MENU_________________________________________ */


    /* .nav-button{
        border: 0;
        display: none;
        border-radius: 4px;
        padding: 8px;
        background-color: black;
        margin: 8px;
        cursor: pointer;
    }
    .nav-button i{
       color:#fff;
    }
    .overlay{
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 9;
        position: fixed;
        width: 0;
        left: 0;
        top: 0;
        overflow-x: hidden;
        transition: all 0.5s;
    }
    .overlay-content{
        position: relative;
        top: 10%;
        width: 100%;
        text-align: center;
        margin-top: 30px;
    }
    .overlay a{
        padding: 8px;
        text-decoration: none;
        color: #818181;
        display: block;
        font-size: 20px;
        transition: 0.3s;
    }
    .overlay a:hover, .overlay a:focus{

        color: white;
    }
    .closebtn{

        position: absolute;
        top: 25px;
        right: 45px;

    } */

    /* ========================= media query ====================*/
@media(max-width: 830px){
        #menu
        {
            display: none;
        }
        .bemvindo{
            font-size: 20px;
            justify-content: center;
        }
        .area-info{

            display: block;


            }

        img{
            height: 200px;
            width: 200px;
            padding-top: 10px;
            margin: 0 auto;
            
        }
        .area-info{
            padding: 20px;
            align-items: center;
            justify-content: center;
        }
        .bemvindo1{
            color: white;
            text-align: center;
            font-size: 25px;

        }
        .bemvindo{
            color: white;
            text-align: center;
            font-size: 30px;

        }
        .msg-bemvindo{
            margin-top: 200px;
        }
        .conteiner1{
            margin-top: 200px;
        }
        .nav-button{

            display: block;

        }

} 

.img_area{

width: 100%;
display: flex;
justify-content: center;
align-items: center;
margin-top: 80px;

}
.img_perfil{
margin-right: 20px;

height: 64px;
width: 64px;
object-fit: cover;
object-position: center;
border-radius: 100%;
padding: 3px;
position: relative ;
background-color: green;
max-width: 64px;

}


.area-info{
    width: 50%;
    display: flex;    
    align-items: center;
    justify-content: center;
}
.area-img-info{
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    
}

  
    
    



/* ========================= FIM media query ====================*/

</style>
<link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
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










        <div class="msg-bemvindo">

            <h1 class="bemvindo">Seja Bem-Vindo Sr(a). <?php echo $_SESSION['nome']  ?></h1>
            <p class="bemvindo1">Nosso Site foi feito para te atender, e aí o que vai querer?</p>

        </div>



        
        <div class="conteiner1">
            <div class="content-conteiner">


                <div class="area-info">
                        
                    <div class="info">
                    
                        <h1>Painel do Aluno</h1>
                        <p>Painel do aluno é uma plataforma criada com intuito de facilitar o acesso dos alunos ao seus documentos, notas e matrículas</p>
                        <br><br><br><br>
                        <a class="link1" href="http://paineldoaluno.ms.gov.br/login" target="_blank">Acessar Painel do Aluno</a>
                    </div>  
                    
                </div>
    

                
                <div class="area-img-info">
    
                    <img class="img-info" src="img/painelauno.png" >
    
                </div>


            </div>

        </div>



        <div class="conteiner2">
            <div class="content-conteiner">


                <div class="area-info">
                        
                    <div class="info">
                        
                        <h1>Instagram Oficial da Escola</h1>
                        <p>Quer se manter informado quanto as novidades da escola em que estuda? Então da uma olhada no perfil da escola no instagram, la você receberá noticias atualizadas. @eejoseantoniopereira</p>
                        <br><br><br><br>
                        <a class="link2" href="https://www.instagram.com/eejoseantoniopereira/" target="_blank">Acessar Instagram</a>
                    </div>
                    
                </div>
    

                
                <div class="area-img-info">
    
                    <img class="img-info" src="img/logo instagram.png" >
    
                </div>


            </div>

        </div>



        <div class="conteiner3">
            <div class="content-conteiner">


                <div class="area-info">
                        
                    <div class="info">
                        
                        <h1>Controladoria Geral do Estado(CGE)</h1>
                        <p>São funções básicas da Controladoria-Geral do Estado as atividades de auditoria governamental, de correição e de ouvidoria, condução à transparência pública e ao controle social e apoio ao controle externo na sua missão institucional.</p>
                        <br><br><br><br>
                        <a class="link3" href="https://www.cge.ms.gov.br/" target="_blank">Acessar</a>
                    </div>
                    
                </div>
    

                
                <div class="area-img-info">
    
                    <img class="img-info" src="img/Brasão_de_Mato_Grosso_do_Sul.svg.png" >
    
                </div>


            </div>

        </div>

        
       


    
    </body>

    <script type="text/javascript" src="menu_responsivo.js"></script>
</html>