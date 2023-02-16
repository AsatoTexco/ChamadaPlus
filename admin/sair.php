<?php
session_start();
ob_start();
unset($_SESSION['adm_id'], $_SESSION['adm_nome']);

$_SESSION['msg'] = "<p style='color: #00ff00;text-align: center;font-size: 15px'  >Admin deslogado com Sucesso";

header("Location: ../admin.php");