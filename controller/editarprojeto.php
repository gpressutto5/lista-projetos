<?php
if (isset($_GET['name'])){
    $nome = $_GET['name'];
    if (is_dir($nome)){
        $path = $_SERVER['DOCUMENT_ROOT']."/".$nome;

        $descricao = '';
        if (file_exists($path . "/desc.md")){
            $descricao = htmlspecialchars(file_get_contents($path . "/desc.md"));
        }
    }else{
        $msg->error('Não existe nenhum projeto com esse nome.');
        header('Location: ./');
    }
}else{
    header('Location: ./');
}

require "view/editarprojeto.view.php";
