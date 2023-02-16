<?php

require "config.php";

$lista = [];
$id = filter_input(INPUT_POST, 'id');




    $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    


    if($sql-> rowCount() > 0){

    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach($lista as $dadosAluno){
    
        if($dadosAluno['turma'] == 'A'){
    
            print "UGA UGA";
    
        }
    }
}


    

?>






<h1>EAEAEAEAEAEAE</h1>

<?php foreach($lista as $dadosAluno):?>
    <table border="1">

    <tr>

    <th>Nome</th>
    <th>Série</th>
    <th>Telefone</th>
    
    
    </tr>
    <tr>
        <td><?=$dadosAluno['nome']?></td>
        <td><?=$dadosAluno['ano']?><?=$dadosAluno['turma']?></td>
        <td><?=$dadosAluno['phone']?></td>
        


    </tr>

    <?php endforeach; ?>
    </table>