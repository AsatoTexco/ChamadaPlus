<?php
session_start();
ob_start();
 require 'config.php';

if(!isset($_SESSION['id'])){

    $_SESSION['msg'] = "<p style='color: #ff0000;text-align: center;font-size: 15px'  >Necessário entrar em sua conta primeiro";
    header("Location: index.php");
}else{

    $idS = filter_input(INPUT_GET,'id');
    
    $sql = $pdo->prepare("SELECT * FROM alunos  WHERE id  = :id");
    $sql->bindValue(':id', $_SESSION['id']);
    $sql->execute();

    $seguindo = [];
    $seguindo = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach($seguindo as $segui){

        $seg = $segui['seguindo'];

    }

    

    $letrafinal = substr($seg, -1);
    
    if($letrafinal == ","){

        
        $seguindo_after = str_replace($idS.",", '', $seg);

    }else{

        $seguindo_after = str_replace($idS, '', $seg); str_replace(",,",'',$seg);
        
    
        
    }

        // $seguindo_after = str_replace(",,", '', $seg);

        $string = strpos($seg, ',');

        if($string == true){
            $seguindo_after = str_replace(",,", ',', $seguindo_after);
        } 

        $seguindo_after = rtrim($seguindo_after, ",");
    
        
        if(($seguindo_after[0]) == ","){

            $seguindo_after = ltrim($seguindo_after, ',');

        }
       

        $sql = $pdo->prepare("UPDATE alunos SET seguindo = :seguindo WHERE id = :id"); 
                        
            $sql->bindValue(':seguindo',$seguindo_after);
            $sql->bindValue(':id', $_SESSION['id']);
            $sql->execute();
        


            // echo substr($seguindo_after, 0);
        $_SESSION['action_js'] = "<input type='hidden' value='1' id='teste'>";
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));







}