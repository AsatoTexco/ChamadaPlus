<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}else{


    $idS = filter_input(INPUT_GET, 'id');
    if($idS == $_SESSION['id']){
        header("Location: menu.php");
    }else{


        $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id AND seguindo LIKE '%".$idS."%'");
        $sql->bindValue(':id', $_SESSION['id']);
        $sql->execute();
    
        if($sql->rowCount() == 0 ){
    
    
            
            $sql = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
            $sql->bindValue(':id', $_SESSION['id']);
            $sql->execute();
        
        
            $valor = $sql->fetchAll(PDO::FETCH_ASSOC); 
        
            foreach($valor as $valor1){
        
                $seguindo = $valor1['seguindo'];
            }
            if($seguindo == null){
    
                $seguindo_after = ($idS);
            }else{
    
                $seguindo_after = ($seguindo .",".$idS);
    
            }
            
        
            $sql = $pdo->prepare("UPDATE alunos SET seguindo = :seguindo WHERE id = :id"); 
                        
            $sql->bindValue(':seguindo',$seguindo_after);
            $sql->bindValue(':id', $_SESSION['id']);
            $sql->execute();
            
            
            // echo($seguindo_after);
            
            header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
    
    
        }else{
    
            header("Location: menu.php");
    
        }
    
        
    }





    }

?>