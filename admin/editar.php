<?php
session_start();
ob_start();
 require '../config.php';

if(!isset($_SESSION['adm_id']) && !isset($_SESSION['adm_nome'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 13px'  >Necessário entrar em sua conta primeiro";
    header("Location: ../admin.php");
}

// _____________________________________________SESSION____________________________________

$id = filter_input(INPUT_GET, 'id');

if(isset($id)){

    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowCount() > 0){

        $dadosAluno = $sql->fetch(PDO::FETCH_ASSOC);

    }else{

        // header("Location: index.php");
        // exit;
    }



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

<style>
html{

    background-image: linear-gradient(45deg,white,black);

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
.inp_texto{

    border-radius: 10px;
    width: 100%;
    border: none;
    outline: none;
    padding: 10px;

}
.editar{
    width: 100%;
    padding: 15px;
    border-radius: 15px;
    font-size: 20px;
    cursor: pointer;
}
.editar:hover{

    background-color: black;
    color: white;

}


</style>
</head>




<body>


    <form method="POST" action="editar_action.php">
    <?php
        if(isset($_SESSION['msg'])){
        
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        
        }
    ?>
    
    <h1>Editar informações do Aluno</h1>
    <input type="hidden" name="id" value="<?=$dadosAluno['id'];?>"/>

    <label>

        Número Chamada:<br>  <input type="text" class="inp_texto" maxlength="2" minlength="2" name="NChamada" value="<?=$dadosAluno['NChamada']?>">

    </label>
    <br><br>
    

    <label>

        Nome: <br> <input type="text" class="inp_texto" name="nome" value="<?=$dadosAluno['nome'];?>"/>

    </label>

    <br><br>

    <label>

        E-mail:<br>  <input type="text" class="inp_texto" name="email" value="<?=$dadosAluno['email'];?>"/>

    </label>

    <br><br>

    <label>

        Senha: <br> <input type="text" maxlength="25" class="inp_texto" name="senha" value="<?=$dadosAluno['senha'];?>"/>

    </label>

    <br><br>

    <label>

        Telefone:  <br><input type="number" class="inp_texto" name="phone" value="<?=$dadosAluno['phone'];?>"/>

    </label>

   

    <br><br>

    <label>

        Ano:    <br>
                1°<input type="radio" value="1" name="ano"<?php echo ($dadosAluno['ano'] == "1") ? "checked" : null; ?>> 
                2°<input type="radio" value="2" name="ano"<?php echo ($dadosAluno['ano'] == "2") ? "checked" : null; ?>> 
                3°<input type="radio" value="3" name="ano"<?php echo ($dadosAluno['ano'] == "3") ? "checked" : null; ?>> 
                 

    </label>

    <br><br>
    
    <label>

        Turma:  <br>  A<input type="radio" value="A" name="turma"<?php echo ($dadosAluno['turma'] == "A") ? "checked" : null; ?>> 
                B<input type="radio" value="B" name="turma"<?php echo ($dadosAluno['turma'] == "B") ? "checked" : null; ?>> 
                C<input type="radio" value="C" name="turma"<?php echo ($dadosAluno['turma'] == "C") ? "checked" : null; ?>> 
                D<input type="radio" value="D" name="turma"<?php echo ($dadosAluno['turma'] == "D") ? "checked" : null; ?>> 

    </label>
    <br><br>

    </label>

    <input type="submit" value="Editar" class="editar"/>
    


    </form>

</body>

</html>
