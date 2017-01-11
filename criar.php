<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

function createFile($path, $nome, $content){
    if (!($fp = fopen($path."/".$nome,"wb")))
        return false;
    if (!fwrite($fp,$content))
        return false;
    if (!fclose($fp))
        return false;
    return true;
}

if (!empty($_POST['nome'])){
    $nome = str_replace('/', '_', $_POST['nome']);
    $nome = str_replace(' ', '-', $nome);

    $path = [];
    $path['folder'] = $_SERVER['DOCUMENT_ROOT']."/".$nome;
    $path['template'] = $_SERVER['DOCUMENT_ROOT']."/template/";
    $path['cssdir'] = $path['template']."css/";
    $path['jsdir'] = $path['template']."js/";
    $path['newcssdir'] = $path['folder']."/css/";
    $path['newjsdir'] = $path['folder']."/js/";

    if (!is_dir($nome)){
        mkdir($path['folder']);

        $content = '';
        if (isset($_POST['template'])){
            mkdir($path['folder']."/css");
            mkdir($path['folder']."/js");
            copy($path['cssdir']."style.css", $path['newcssdir']."style.css");
            copy($path['cssdir']."bootstrap.min.css", $path['newcssdir']."bootstrap.min.css");
            copy($path['jsdir']."bootstrap.min.js", $path['newjsdir']."bootstrap.min.js");
            copy($path['jsdir']."jquery-3.1.1.min.js", $path['newjsdir']."jquery-3.1.1.min.js");
            copy($path['jsdir']."main.js", $path['newjsdir']."main.js");
            $content = str_replace("DataAno", date("Y"), str_replace("NomePagina", $nome, file_get_contents($path['template'] . "index.temp.php")));
        }

        createFile($path['folder'], 'index.php', $content);
        $desc = '';
        if (isset($_POST['descricao'])){
            $desc = $_POST['descricao'];
        }
        createFile($path['folder'], 'desc.md', $desc);
        $msg->success("O projeto $nome foi criado com sucesso!");
        header("Location: ./");
    }else{
        $msg->error("Já existe uma pasta com esse nome!");
        header("Location: ./novo/");
    }
}else{
    $msg->error("Nome inválido!");
    header("Location: ./novo/");
}
