<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

function createFile($path, $nome, $content){
    if (!($fp = fopen($path.$nome,"wb")))
        return false;
    if (!fwrite($fp,$content))
        return false;
    if (!fclose($fp))
        return false;
    return true;
}

if (!empty($_POST['nome'])) {
    $nome = $_POST['nome'];
    $checkNome = false;
    $checkDesc = false;

    $changeName = $_POST['nomeoriginal'] !== $nome ? true : false;
    $nome = str_replace('/', '_', $nome);
    $nome = str_replace(' ', '-', $nome);
    $path = [];
    $path['folder'] = $_SERVER['DOCUMENT_ROOT'] . "/" . $nome;
    $path['file'] = $path['folder'] . "/";
    $path['oldname'] = $_SERVER['DOCUMENT_ROOT'] . "/" . $_POST['nomeoriginal'];
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        foreach ($path as $k => $v){
            $path[$k] = str_replace('/', '\\', $path[$k]);
        }
    }


    if ($changeName){
        if (is_dir($nome)){
            echo $path['file'] . "index.php";
            if (file_exists($path['file'] . "index.php")){
                $msg->error("Já existe um projeto com esse nome!");
            }else{
                $msg->error("Nome inválido!");
            }
            header("Location: ./editarprojeto.php?name=".$_POST['nomeoriginal']);
            exit;
        }else{
            if (rename($path['oldname'], $path['folder'])){
                $checkNome = true;
            }
        }
    }

    if ($_POST['descricaooriginal'] !== $_POST['descricao']){
        if (file_exists($path['file']."desc.md")){
            if (!unlink($path['file']."desc.md")){
                $msg->error("Erro ao apagar arquivo desc.md");
            }
        }
        if (createFile($path['file'], 'desc.md', $_POST['descricao'])){
            $checkDesc = true;
        }
    }

    if (!$checkNome && !$checkDesc){
        $msg->warning("Nada foi alterado!");
    }else if ($checkNome && $checkDesc){
        $msg->success("O nome e a descrição do projeto foram alterados.");
    }else if($checkNome){
        $msg->success("O nome do projeto foi alterado.");
    }else{
        $msg->success("A descrição do projeto foi alterada.");
    }
    header("Location: ./");
    exit;
}else{
    $msg->error("Nome inválido!");
    header("Location: ./editarprojeto.php?name=".$_POST['nomeoriginal']);
}