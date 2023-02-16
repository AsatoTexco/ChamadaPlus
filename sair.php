<?php
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome']);

$_SESSION['msg'] = "<p style='color: #00ff00;text-align: center;font-size: 15px'  >Usuário deslogado com Sucesso";

header("Location: index.php");