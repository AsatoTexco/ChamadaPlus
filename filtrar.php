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

        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :ano AND turma = :turmaF AND nome LIKE '%".$nomeF."%'");
        $sql->bindValue(':ano', $anoF);
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        echo "ano, nome e turma";


    }



    else if(!empty($nomeF) and !empty($turmaF)){

        $lista = [];
        
        
        // ====================================LIKE COM NOME DA VARIAVEL================================================

        // SELECT * FROM alunos WHERE turma = 'A' and nome like '%e%';
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE turma = :turmaF AND nome LIKE '%".$nomeF."%'");
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        

    } else if(!empty($anoF) and !empty($nomeF)){
    
        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF and nome LIKE '%".$nomeF."%'");
        $sql->bindValue(':anoF', $anoF);
        $sql->execute();
        

    } else if(!empty($anoF) and !empty($turmaF)){
    
        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF and turma = :turmaF");
        
        $sql->bindValue(':anoF', $anoF);
        $sql->bindValue(':turmaF', $turmaF);
        $sql->execute();

        
    }
    

    else if(!empty($turmaF)){

        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE turma = :turmaF");
        $sql->bindValue(':turmaF', $turmaF);
        
        $sql->execute();
    
        
    }

    else if(!empty($nomeF)){

        $lista = [];
        
        // ====================================LIKE COM NOME DA VARIAVEL================================================


        $sql = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE '%".$nomeF."%'");
        
        $sql->execute();

        
    }
       


       

        else if(!empty($anoF)){
        $lista = [];
        $sql = $pdo->prepare("SELECT * FROM alunos WHERE ano = :anoF");
        $sql->bindValue(':anoF', $anoF);
        
        $sql->execute();
        
    }
    
    
    

    if($sql->rowCount() > 0 ){
    
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

    
    }  
    

}else{


    $lista = [];
    $sql = $pdo->query("SELECT * FROM alunos");
    
    if($sql->rowCount() > 0 ){
    
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }

}



    
    
    

?>

<head>

   <style>


    h1{
        color: white;
    }
    body{
        background-image: linear-gradient(45deg,black, green, black);

    }
    table{
        
       /* background-color: green; */
       text-align: center;
       border-color: green;
       width: 80%;
       font-size: 20px;
       background: white;
       border-radius: 15px;
       color: black;
       
       
    }
    @media(max-width: 600px){
        
        table{
            font-size: 5px;
        }

    }

    table th,td{
        padding: 1px;
    }

    h1{
        text-align: center;
    }

    .tabelas{
        display: flex;
        justify-content: center;
        /* background-color: green; */
        

    }
    .input{

        width: 100px;
        padding: 15px;
        border-radius: 15px;
        

    }

    @media(max-width: 600px){

        .input{

        width: 50px;
        padding: 7px;
        border-radius: 7px;


}

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
    
    </style>
    <link rel="stylesheet" type="text/css" href="css/menu.css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/responsive_navbar.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<title>Filtrar alunos</title>


<!-- =================  menu  ========================== -->
<div class="areaMenu">

    <nav id="menu">

            
        <ul>
        
            <li><a href="menu.php">Home</a></li>

            <li><a href="lista_presenca.php">Minhas Presenças</a></li>

            <li><a href="sobre.php">Sobre</a></li>

            <li><a href="filtrar.php">Filtrar</a></li>

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
    <div class="overlay-content" >

        <a href="menu.php">Menu</a>
        <a href="lista_presenca.php">Minhas Presenças</a>
        <a href="sobre.php">Sobre</a>
        <a href="filtrar.php">Filtrar</a>
        <a href="perfil.php">Perfil</a>
        <a href="buscar.php">Buscar</a>
        <a href="sair.php">Sair</a>


    </div>
</div>

<button class="nav-button" onclick="openNav()">
    <i class="fa-solid fa-bars fa-2x"></i>
</button>

<!-- =================  FIM menu  ========================== -->





<h1>Fitrar Alunos</h1>
<br><br>

<form action="" method="POST"> 
    
    <label>
        
        Ano:   <input class="input"type="number" max="4" min="1" name="anoF" placeholder="Ano">
        
        
    </label>
    
    <label>

        Turma:  <input class="input"type="text" maxlength="1" minlength="1" name="turmaF" placeholder="Turma" >

    </label>


    <label>

        Nome:  <input class="input-nome"type="text" name="nomeF" placeholder="Insira o seu Nome">

    </label>
    <input class="bot-sub"type="submit" value="Filtrar">

   



</form>
<br><br><h1>Listagem de Alunos</h1>
<div class="tabelas">


    <table border="3">
    
        <tr>
    
            <th>ID</th>
            <th>Número da Chamada</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Série</th>
            <!-- <th>Ações</th> -->
    
        </tr>
        <?php foreach($lista as $dadosAluno):?>
    
        <tr>
    
            <td><?=$dadosAluno['id']?></td>
            <td><?=$dadosAluno['NChamada']?></td>
            <td><?=$dadosAluno['nome']?></td>
            <td><?=$dadosAluno['email']?></td>
            
            <td><?=$dadosAluno['phone']?></td>
            <td><?=$dadosAluno['ano'].$dadosAluno['turma']?></td>
            
            <!-- <td>
    
                <a href="editar.php?id=<?=$dadosAluno['id'];?>">[ Editar ]</a>
                <a href="excluir.php?id=<?=$dadosAluno['id'];?>">[ Excluir ]<a>
    
            </td> -->
    
        </tr> 
        
        <?php endforeach; ?>
    
    </table>

</div>
</body>
