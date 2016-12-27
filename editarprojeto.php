<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

if (isset($_GET['name'])){
    $nome = $_GET['name'];
    if (is_dir($nome)){
        $path = [];
        $path['folder'] = $_SERVER['DOCUMENT_ROOT']."/".$nome;
        $path['file'] = $path['folder'] . "/";

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            foreach ($path as $k => $v){
                $path[$k] = str_replace('/', '\\', $path[$k]);
            }
        }


        $descricao = '';
        if (file_exists($path['file'] . "desc.md")){
            $descricao = htmlspecialchars(file_get_contents($path['file'] . "desc.md"));
        }
    }else{
        $msg->error('Não existe nenhum projeto com esse nome.');
        header('Location: ./');
    }
}else{
    header('Location: ./');
}
?>
<html>
<head>
    <title>Adicionar Projeto</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
            background-color: #e1ffff;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #8bc0cc;
        }
        .container {
            width: auto;
            max-width: 680px;
            padding: 0 15px;
        }
        .container .text-muted {
            margin: 20px 0;
            color: #4e6f79;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Editar Projeto</h1>
    <?php
    $msg->display();
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="/editar.php">
                <input type="hidden" value="<?= $nome ?>" name="nomeoriginal">
                <input type="hidden" value="<?= $descricao ?>" name="descricaooriginal">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input id="nome" type="text" class="form-control" name="nome" value="<?= $nome ?>">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input id="descricao" type="text" class="form-control" name="descricao" value="<?= $descricao ?>">
                </div>
                <button type="submit" class="btn btn-primary">Editar</button>
            </form>
            <a href="/" class="btn btn-default">Voltar</a>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Voce está usando a versão <?= phpversion() ?> do php.</p>
    </div>
</footer>


<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>