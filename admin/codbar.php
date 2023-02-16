<?php

session_start();
ob_start();
 require '../config.php';

if(!isset($_SESSION['adm_id']) && !isset($_SESSION['adm_nome'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: ../admin.php");
}else{

    $sql = $pdo->prepare("SELECT * FROM admin WHERE id = :id AND user = :user AND senha = :senha");
    $sql->bindValue(':id', $_SESSION['adm_id']);
    $sql->bindValue(':user', $_SESSION['adm_user']);
    $sql->bindValue(':senha', $_SESSION['adm_senha']);
    $sql->execute();

    // $lista = [];
    // $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

    if($sql->rowCount() == 0 ){

        $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";

    }


}

// _____________________________________SESSION___________________________________

?>
<head>

<style>

body{

background-image: linear-gradient(45deg,white,black,black ,white);

}
.codbar{
   

    background-color: rgb(0, 0, 0, 0.8);
    


}
h1{
    text-align: center;
    font-size: 40px;
    color: white;
}

.input{

    padding: 30px;
    border: none;
    font-size: 20px;
    border-radius: 15px;
    

}
label{
    color: white;
    font-size: 25px;
    
}

.bot-sub{
    
    background-color: white;
    padding: 35px;
    margin-left: 15px;
    border-radius: 15px;
    cursor: pointer;
    font-size: 20px;
    height: 83px;
    width: 150px;
    text-align: center;    
    color: black;

}
.bot-sub:hover{

    
    background-color: green;
    color: white;
    
    transition: all ease-in-out 0.5s;

}

form{

    display: flex;
    justify-content: center;
}
</style>


</head>
<link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
<div class="areaMenu">

    <nav id="menu">

            
        <ul>
        
            <li><a href="admin_menu.php">Editar Alunos</a></li>

            

            <li><a href="codbar.php">Leitor Código de barras</a></li>
            
            <li class="entrar"><a href="sair.php">Sair</a></li> 
            
                            <!-- SAIR -->
        
        </ul>
    </nav>

</div>


<br>
<br>


    <h1>Leitor Código de barras</h1>

    <br><br>
    <?php 
        if(isset($_SESSION['msg'])){

            echo $_SESSION['msg'] ;
            unset($_SESSION['msg']);
        }
    ?>
    <form method="POST" action="codbar_action.php">
    
        
        <label >
            Código:  <input class="input" type="text" maxlength="4" minlength="4" placeholder="Insira seu Código" name="id">
        </label>
        <br><br>
        <input class="bot-sub"type="submit" value="Enviar">
    
        
    
    
    </form>



