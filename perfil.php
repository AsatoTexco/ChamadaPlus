<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}
// =====================================    SESSION    ======================================

$id_perfil = filter_input(INPUT_GET,'id');
if($id_perfil == null){
  $id_perfil = $_SESSION['id'];
}


$sql = $pdo->prepare("SELECT * FROM alunos WHERE seguindo LIKE '%".$id_perfil."%'");
$sql->execute();

$seguidores = $sql->fetchAll(PDO::FETCH_ASSOC);
$cont = 0;
foreach($seguidores as $seguidores_rows){

$cont++;

}

$sql = $pdo->prepare("SELECT * FROM alunos WHERE id = '".$id_perfil."'");
$sql->execute(); 

$seguindo_result = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($seguindo_result as $seguindo_row){

    $seguindo = $seguindo_row['seguindo'];

}
$seguindo_dividido = [];

$seguindo_dividido = explode(',', $seguindo);


$cont_seguindo = 0;

foreach($seguindo_dividido as $seg_div){

  // se o tamanho da string for + ou = 4 aciona o contador(estava acontecendo de ativar o contador com a posição 0 da array = "")
  if(strlen($seg_div) >= 4){
    $cont_seguindo++;
  }


}




?>



<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="../Chamada/css/menu.css" media="screen" />

  <style>




    *{
      /* font-family: 'Segoe UI Light'; */
      padding: 0;
      margin: 0;
      color: white;
    }
    html{

      background-image: linear-gradient(45deg, black,green,black);
      height: 100%;
      width: 100%;


    }
    
      /* transform: translate(-50%,-50%); */
   .container_perfil{
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin-top: 20px;
    
    
    
   }
   
   
   .about{
    margin-top: 10px;
    flex-direction: column;
    position: relative;
    min-width: 486px;
    max-width: 490px;

   }
   .lista_perfil{
    padding: 10px;
    display: flex;
    justify-content: center;
    text-align: center;
    flex-direction: row;
   }
.lista_perfil li{

  border-radius: 10px;
    float: left;
    padding: 10px;
    margin-left: 10px;
    padding-top: 0;
    list-style-type: none;


}

   .click_li{
    
    float: left;
    padding: 10px;
    margin-left: 10px;
    padding-top: 0;
    list-style-type: none;
   }
   .bot-seg{
    text-align: center;
   }

.ft_perfil_img, .ft_perfil_img1{

    margin-right: 20px;
    
    height: 250px;
    width: 250px;
    object-fit: cover;
    object-position: center;
    border-radius: 100%;
    padding: 3px;
    position: relative ;
    background-color: white;
    transition: all 0.5s;
}


.ft_perfil_img:hover{

  padding: 10px;
  cursor: pointer;

}

.ft_perfil_img1:hover{

padding: 10px;


}
.descricao{
  max-width: 490px;
  word-wrap: break-word;
}

.nome_ft_perfil{
  color: white;
}
.serie_perfil{
  color: white;
}
/* .container_perfil{
  background-color: grey;
} */
.area_bot_seg_perfil{
  display: flex;
  width: 100%;
  align-items: center;justify-content: center;
  height: 80px;
  background-color: black;
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


.cont_overlay_seguidores, .cont_overlay_seguindo{
  height: 100%;
  width: 0;
  
  overflow-x: hidden;
  position: fixed;
  /* background-color: red; */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 8;
  transition: all 0.5;
}
.content{
  overflow-x: hidden;
  height: 50%;
  /* mobile 80% / pc 50%  cell */
  width: 50%;
  /* mobile 100% / pc 50%  cell */
  margin-bottom: 10%;
  background-color: #dbdbdb;
  border-radius: 20px;

}
.click_li{
  cursor: pointer;
}

.click_li:hover{

  background-color: #013306;

}
.closebtn_seg{

  float: right;
  margin-right: 10px;
  color: white;
  text-decoration: none;
  font-size: 40px;
 
  text-align: center;
  

}

.titulo_seg{
  text-align: center;
  color: white;
  margin-top: 12px;
}
.topo-seg{
  
  background-color: black;
  padding: 15px;
}

.area_seguidores{
  height: 100%;
  width: 100%;
  display: flex;
  /* background-color: black; */
  justify-content: center;
  align-items: center;
}
.area_alunos{
  width: 80%;
  /* mobile 90% / pc 80%  cell */
  height: 100%;
  /* background-color: red; */
}
.conteudo_alunos{
  width: 100%;
  margin-top: 10px;
  /* background-color: black; */
  height: 100px;
}


.geral{

  display: flex;
  justify-content: start;
  align-items: center;
  width: 70%;
  height: 100%;
  /* background-color: green; */

}
.aluno{
  display: flex;
  border-radius: 10px;
  background-color: grey;
  height: 100%;
  width: 100%;
}
.img_seguidores{
    height: 64px;
    width: 64px;
    object-fit: cover;
    object-position: center;
    border-radius: 100%;
    padding: 10px;
    position: relative;
}

.about_overlay{
    display: flex;
    justify-content: center;
    flex-direction: column;
    text-decoration: none;
    
}
a{
  text-decoration: none;
}
.area_bot_overlay{
  width: 30%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.area_bot_overlay a{
  padding: 10px;
  color: white;
  border-radius: 500px;
  background-color: red;

}
.aviso_nseg{
  text-align: center;
  color: black;
  font-size: 20px;
}
.aviso_sseg{
  text-align: center;
  color: black;
  font-size: 20px;
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


<!-- 
  <div class="overlay_seguidores" id="overlay_seguidores">
    
    <div class="content">
      
      <a href="javascript:void(0)" class="closebtn" onclick="close_seguidores()">&times;</a>
      <div class="cubo"></div>
    
    </div>

  </div> -->


  <div class="cont_overlay_seguidores" id="cont_overlay_seguidores">

    <div class="content">

      <div class="topo-seg">

        <a href="javascript:void(0)" class="closebtn_seg" onclick="close_seguidores()">&times;</a>
        <h3 class="titulo_seg">seguidores</h3>
        
      </div>
      
      <div class="area_seguidores">

          <div class="area_alunos">

            <?php 
            
              // BUSCAR TODOS DADOS DE QUEM SEGUE ESTE PERFIL 
              $sql = $pdo->prepare("SELECT * FROM alunos WHERE seguindo LIKE '%".$id_perfil."%' ");
              $sql->execute();
              
              $lista_alunos = $sql->fetchAll(PDO::FETCH_ASSOC);

              if($sql->rowCount() == 0){

                echo "<p class='aviso_sseg'>Não possui nenhum seguidor ainda<p>";

              }

                
            
            foreach($lista_alunos as $row_alunos):
            
            


            ?>
            
            <div class="conteudo_alunos">
              
                <div class="aluno">
                  
                  <div class="geral">

                    <?php
                      


                      $idSeg = $row_alunos['id'];
                      $nome = $row_alunos['nome'];
                      $imagem = $row_alunos['imagem'];
                      $turma = $row_alunos['turma'];
                      $ano = $row_alunos['ano'];

                      

                      if($imagem != null){

                        echo("<a class'link_edit' href='perfil.php?id=".$idSeg."'>
                                <img  src='imgsUser/".$idSeg."/ftPerfil/".$imagem."' class='img_seguidores'>
                              </a>");

                      }else{

                        echo("<a class'link_edit' href='perfil.php?id=".$idSeg."'>
                                <img  src='img/ft_nao_encontrada.png' class='img_seguidores'>
                              </a>");

                      }


                    ?>


                    <div class="about_overlay">
    
                        <a href="perfil.php?id=<?=$row_alunos['id']?>"><h3><?=$row_alunos['nome']?></h3>
                        <p><?=$row_alunos['ano']."°".$row_alunos['turma']?></p>
                        </a>
                        
                    </div>       

                   

                  </div>

                  <?php

                      if($id_perfil == $_SESSION['id']){

                        echo("<div class='area_bot_overlay'>

                                  <a href='remover_seguidor.php?id=".$idSeg."'>Remover</a>
                    
                              </div>");

                      }

                  ?>


                </div>
            </div>

        <?php 
        endforeach
        ?>

        </div>
      </div>
    </div>

  </div>









  <!-- ========================= SEGUINDO ===================== -->









  <div class="cont_overlay_seguindo" id="cont_overlay_seguindo">

<div class="content">

  <div class="topo-seg">

    <a href="javascript:void(0)" class="closebtn_seg" onclick="close_seguindo()">&times;</a>
    <h3 class="titulo_seg">seguindo</h3>
    
  </div>
  
  <div class="area_seguidores">

      <div class="area_alunos">

        <?php 
        
          // BUSCAR TODOS DADOS DE QUEM SEGUE ESTE PERFIL 
          $sql = $pdo->prepare("SELECT * FROM alunos WHERE id  = :id ");
          $sql->bindValue(':id',$id_perfil);
          $sql->execute();
          
          $seguindo_result = $sql->fetchAll(PDO::FETCH_ASSOC);

          foreach($seguindo_result as $seguindo_rows){

            $seguindo = $seguindo_rows['seguindo'];

          }
          
          $array_seg = explode(',',$seguindo);

          

          if($array_seg != null){
            
          }else{
            
          }
          
          
         

           foreach($array_seg as $row_alunos_seg):

          
        
        
        ?>
        
        <div class="conteudo_alunos">
          <?php
          if($row_alunos_seg == null){
            echo "<p class='aviso_nseg'>Não segue ninguém ainda<p>";
          }else{

            echo("<div class='aluno'>
            <div class='geral'>");
          }
            
          ?>
            

                <?php
                  
                if($row_alunos_seg == null){
                  // echo "<p class='aviso_nseg'>Não possui nenhum seguidor ainda<p>";
                }else{


                  $sql = $pdo->prepare("SELECT * FROM alunos  WHERE id = :id");
                  $sql->bindValue(':id', $row_alunos_seg);
                  $sql->execute();

                  $seg_result = $sql->fetchAll(PDO::FETCH_ASSOC);

                  foreach($seg_result as $row_seg_result){
                    
                    
                    $idSeg_seg = $row_seg_result['id'];
                    $nome_seg = $row_seg_result['nome'];
                    $imagem_seg = $row_seg_result['imagem'];
                    $turma_seg = $row_seg_result['turma'];
                    $ano_seg = $row_seg_result['ano'];
                    $seguindo_seg = $row_seg_result['seguindo'];
                                      


                  }


                  

                  if($imagem_seg != null){

                    echo("<a class'link_edit' href='perfil.php?id=".$idSeg_seg."'>
                            <img  src='imgsUser/".$idSeg_seg."/ftPerfil/".$imagem_seg."' class='img_seguidores'>
                          </a>");

                  }else{

                    echo("<a class'link_edit' href='perfil.php?id=".$idSeg_seg."'>
                            <img  src='img/ft_nao_encontrada.png' class='img_seguidores'>
                          </a>");

                  }


                    echo("<div class='about_overlay'>

                    <a href='perfil.php?id=".$idSeg_seg."'><h3>".$nome_seg."</h3>
                    <p>".$ano_seg."°".$turma_seg."</p>
                    </a>
                    
                </div>  ");

                }
                  
                  


                ?>


                     

               

              </div>

              <?php

                  if($id_perfil == $_SESSION['id']){
                    if($row_alunos_seg != null){
                    echo("<div class='area_bot_overlay'>

                              <a href='unfollow.php?id=".$idSeg_seg."'>unfollow</a>
                
                          </div>");
                    }

                  }

              ?>


            </div>
        </div>

    <?php 
    endforeach
    ?>

    </div>
  </div>
</div>

</div>











  <!-- ========================== SEGUINDO ====================== -->



  <div class="container_perfil">
  
    <?php 
    
  
    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $sql->bindValue(':id', $id_perfil);
    $sql->execute();
    
            
    $dados_aluno_perfil = $sql->fetchAll(PDO::FETCH_ASSOC);
  
    foreach($dados_aluno_perfil as $dados_aluno){
  
        $nome_img = $dados_aluno['imagem'];
        $nome = $dados_aluno['nome'];
        $ano = $dados_aluno['ano'];
        $turma = $dados_aluno['turma'];
        $desc = $dados_aluno['descricao'];
  
  
    }
    // se o id da de quem esta acessando for igual ao id do perfil, ficara disponivel o link para edição da imagem
    if($_SESSION['id'] == $id_perfil){
  
      if($nome_img == null){
  
        echo("<div class='area_link_imagem_perfil'><a class='link_ft_perfil_img' href='edit_perfil.php?id=".$id_perfil."'>
                <img src='img/ft_nao_encontrada.png' class='ft_perfil_img'>
              </a></div>");
  
      }else{
  
        echo("<div class='area_link_imagem_perfil'><a class='link_ft_perfil_img' href='edit_perfil.php?id=".$id_perfil."'>
                  <img src='imgsUser/".$id_perfil."/ftPerfil/".$nome_img."' class='ft_perfil_img'>
              </a></div>");
  
      }
  
  
  
      // echo(" <a href='edit_perfil.php?id=".$id_perfil."'>
      //           <img src='imgsUser/".$id_perfil."/ftPerfil/".$nome_img."' class='img'>
      //        </a>");
  
    }else{
      if($nome_img == null){
  
        echo("<div class='area_link_imagem_perfil'><img src='img/ft_nao_encontrada.png' class='ft_perfil_img1'></div>");
  
      }else{
  
        echo("<div class='area_link_imagem_perfil'><img src='imgsUser/".$id_perfil."/ftPerfil/".$nome_img."' class='ft_perfil_img1'></div>");
  
      }
  
      // echo("<img src='imgsUser/".$id_perfil."/ftPerfil/".$nome_img."' class='img1'>");
    }
  
    ?>
      <!-- <a href="edit_perfil.php">
        <img src="imgsUser/<?=$id_perfil?>/ftPerfil/<?=$nome_img?>" class="img">
      </a> -->
      
    <div class="about">
  
  
      <h1 class="nome_ft_perfil"><?=$nome?></h1>
      <h2 class="serie_perfil"><?=$ano."°".$turma?></h2>
  
  
      <div class="area_lista_perfil">
  
      <!-- VER A QUANTIDADE DE SEGUIDORES, PESSOAS QUE VOCE SEGUE E AO CLICAR VER DETALHADAMENTE -->
      
        <ul class="lista_perfil">
          <li><h3 onclick="vis_publi()">0</h3><p> Publicações</p> </li>
          <li class="click_li" onclick="vis_seguidores()"><h3><?=$cont?></h3><p> Seguidores</p> </li>
          <li class="click_li" onclick="vis_seguindo()"><h3><?=$cont_seguindo?></h3><p> Seguindo</p> </li>
        </ul>
  
      
      </div>
      <!-- ola meu nome é arthur tenho 16 anos e estou prestes a criar um novo facebook pq eu quero, se eu n quisesse eu n estava criando esse site mamacada
        se vc esta lendo isso é pq eu sou foda,
        faço aniversario em 9 de fevereiro de dois mil e seis e por conta disso continuo sendo foda mas com quase 17 anos -->
      <p class="descricao"><?=$desc?></p>
    </div>

       
  </div>
  <div class="area_bot_seg_perfil">

  <?php 

$id = $_SESSION['id'];

$sql = $pdo->prepare("SELECT seguindo FROM alunos WHERE id = :id AND seguindo LIKE '%".$id_perfil."%'");
$sql->bindValue(':id', $id);
$sql->execute();

$seg = $sql->fetchAll(PDO::FETCH_ASSOC);
if($id_perfil == $_SESSION['id'] ){

//   ====================  MUDANÇA JA ======================
    $id1 = $id_perfil;
    $f_or_u = "editar"; 
    $link='edit_perfil';
    
}
else if($sql->rowCount() == 0 ){

    $id1 = $id_perfil;
    $f_or_u = "seguir"; 
    $link='seguir';

                                       
}else{

    $id1 = $id_perfil;
    $f_or_u = "unfollow"; 
    $link='unfollow';

}


?>

<a class="<?=$f_or_u?>" href="<?=$link?>.php?id=<?=$id_perfil;?>"><?=$f_or_u?></a>

  </div>

<?php 

if(isset($_SESSION['action_js'])){
  echo($_SESSION['action_js']);
  unset($_SESSION['action_js']);
}

?>




  
  
<script type="text/javascript" src="menu_responsivo.js"></script>
</body>
</html>