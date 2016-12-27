<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

if (isset($_GET['name'])){
    if (!empty($_GET['name'])){
        $nome = str_replace("/", "", $_GET['name']);
        $nome = str_replace("..", "", $nome);
        if ($nome && is_dir($nome)){
            $path = $_SERVER['DOCUMENT_ROOT']."/".$nome;
            if (file_exists($path."/index.php")){
                if (PHP_OS === 'Windows') {
                    exec(sprintf("rd /s /q %s", escapeshellarg($path)));
                } else {
                    exec(sprintf("rm -rf %s", escapeshellarg($path)));
                }
                $msg->success("O projeto $nome foi apagado com sucesso!");
                header("Location: ./");
                exit;
            }else{
                $msg->error("A pasta $nome não é um projeto!");
                header("Location: ./");
                exit;
            }
        }else{
            $msg->error("Não existe projeto com o nome $nome!");
            header("Location: ./");
            exit;
        }
    }
}
$msg->error("Erro ao apagar o projeto $nome!");
header("Location: ./");
exit;
